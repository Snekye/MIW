<?php
// namespace App\Security\Authentication;

// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
// use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
// use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;

// use Doctrine\ORM\EntityManagerInterface;
// use App\Entity\AdminAccessLog;


// class AuthenticationSuccessHandler extends AbstractLoginFormAuthenticator implements AuthenticationSuccessHandlerInterface
// {
//     private $manager;
//     public function __construct(EntityManagerInterface $entityManager)
//     {
//         $this->manager = $entityManager;
//     }

//     public function onAuthenticationSuccess(Request $request, TokenInterface $token): ?Response
//     {
//         $log = new AdminAccessLog();
//         $log->setUserLogin($token->getUser());
//         $log->setSuccess(true);
//         $this->manager->persist($log);

//         return null;
//     }
// }