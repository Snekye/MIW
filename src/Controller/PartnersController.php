<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Partenaire;
use App\Controller\BaseController;

class PartnersController extends AbstractController
{
    #[Route('/partners', name: 'partners')]
    public function news(EntityManagerInterface $m): Response
    {
        return $this->render('partners.html.twig', [
            'partners' => $m->getRepository(Partenaire::class)->findAll(),
        ] + BaseController::getBase($m));
    }
}