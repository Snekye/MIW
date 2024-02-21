<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\RecrutementPoste;
use App\Controller\BaseController;

class HiringController extends AbstractController
{
    #[Route('/hiring', name: 'hiring')]
    public function news(EntityManagerInterface $m): Response
    {
        return $this->render('hiring.html.twig', [
            'jobs' => $m->getRepository(RecrutementPoste::class)->findAll(),
        ] + BaseController::getBase($m));
    }
}