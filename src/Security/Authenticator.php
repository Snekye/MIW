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

class Authenticator extends AbstractLoginFormAuthenticator
{
    public function supports(Request $request): bool
    {
        return (!is_null($request->request->get('_username')));
    }

    public function authenticate(Request $request): Passport
    {
        $login = $request->request->get('_username');
        $password = $request->request->get('_password');
        $turnstile = $request->request->get('cf-turnstile-response');

        //check turnstile

        //dd($request);

        return new Passport(new UserBadge($login), new PasswordCredentials($password));
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