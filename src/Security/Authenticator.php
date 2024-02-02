<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

use Doctrine\Persistence\ObjectManager;
use App\Entity\AdminAccessLog;

class Authenticator extends AbstractLoginFormAuthenticator
{
    public function __construct(private HttpClientInterface $client, ObjectManager $manager) 
    {
        $this->http = $client;
        $this->manager = $manager;
    }

    public function supports(Request $request): bool
    {
        return (!is_null($request->request->get('_username')));
    }

    public function authenticate(Request $request): Passport
    {
        $login = $request->request->get('_username');
        $password = $request->request->get('_password');
        $turnstile = $request->request->get('cf-turnstile-response');

        $response = $this->http->request(
            'POST', 
            'https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                'body' => [
                    'secret' => $_ENV['TURNSTILE_SECRET'],
                    'response' => $turnstile
                ]
            ]);
        $code = $response->getStatusCode();
        $content = json_decode($response->getContent(), true);
        
        if ($code == 200) 
        {
            if ($content['success'] === true) 
            {
                $log = new AdminAccessLog();
                $log->setSuccess(true);
                $log->setMessage("L'utilisateur [".$login."] est connecté.");
                $this->manager->persist($log);
                $this->manager->flush();
                return new Passport(new UserBadge($login), new PasswordCredentials($password));
            }
            else
            {
                $log = new AdminAccessLog();
                $log->setSuccess(false);
                $log->setMessage("L'utilisateur [".$login."] a été refusé. [Turnstile error : 200 - ".implode(";",$content['error-codes']).']');
                $this->manager->persist($log);
                $this->manager->flush();
                throw new CustomUserMessageAuthenticationException(
                    'Une erreur est survenue, essayez de recharger la page. [Turnstile 200 - '.implode(";",$content['error-codes']).']');
            }
        }
        else 
        {
            $log = new AdminAccessLog();
            $log->setSuccess(false);
            $log->setMessage("L'utilisateur [".$login."] a été refusé. [Turnstile error ".$code);
            $this->manager->persist($log);
            $this->manager->flush();
            throw new CustomUserMessageAuthenticationException(
                'Une erreur est survenue, essayez de recharger la page. [Turnstile '.$code.']');
        }
    }

    public function getLoginUrl(Request $request): string
    {
        return '/login';
    }
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return new RedirectResponse('admin');    
    }
}