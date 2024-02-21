<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\RecrutementPoste;
use App\Controller\BaseController;

class StaticPagesController extends AbstractController
{
    #[Route('/miw-web', name: 'miw-web')]
    public function miw_web(EntityManagerInterface $m): Response
    {
        return $this->render('miw-web.html.twig', BaseController::getBase($m));
    }
    #[Route('/miw-informatique', name: 'miw-informatique')]
    public function miw_informatique(EntityManagerInterface $m): Response
    {
        return $this->render('miw-informatique.html.twig', BaseController::getBase($m));
    }
    #[Route('/miw-telecom', name: 'miw-telecom')]
    public function miw_telecom(EntityManagerInterface $m): Response
    {
        return $this->render('miw-telecom.html.twig', BaseController::getBase($m));
    }
    #[Route('/miw-magasin', name: 'miw-magasin')]
    public function miw_magasin(EntityManagerInterface $m): Response
    {
        return $this->render('miw-magasin.html.twig', BaseController::getBase($m));
    }
}