<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Projet;
use App\Controller\BaseController;

class ErrorController extends AbstractController
{
    #[Route('/error', name: 'error')]
    public function error(EntityManagerInterface $m, \Throwable $exception = null): Response
    {
        $base = BaseController::getBase($m);

        $code = $exception instanceof HttpException ? $exception->getStatusCode() : 500;
        switch ($code) {
            case 404:
                $message = "La page demandée n'est pas disponible.";
                break;
            case 418:
                $message = "Je suis une théière.";
                break;
            case 500:
                $message = "Une erreur interne est survenue.";
                break;
            case 503: 
                $message = "Service indisponible ou en maintenance.";
                break;
            default:
                $message = "Une erreur est survenue.";
        }
        $detail = ($exception && $base["info"]["site_visibilite"] == "debug") ? $exception->getMessage() : null;

        return $this->render('error/error.html.twig', [
                'code' => $code,
                'message' => $message,
                'detail' => $detail,
            ] + $base)
            ->setStatusCode($code);
    }
}