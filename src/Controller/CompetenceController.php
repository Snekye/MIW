<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Competence;
use App\Controller\BaseController;

class CompetenceController extends AbstractController
{
    #[Route('/competences', name: 'competences')]
    public function competences(EntityManagerInterface $m): Response
    {
        return $this->render('competence.html.twig', [
            'competences' => $m->getRepository(Competence::class)->findAll(),
        ] + BaseController::getBase($m));
    }
}


