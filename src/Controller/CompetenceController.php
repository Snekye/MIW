<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;

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


    #[Route('/competences/detail/{slug}', name: 'competence-detail')]
    public function competences_detail(EntityManagerInterface $m, string $slug): Response
    {
        $c = $m->getRepository(Competence::class)->findOneBy(["titre_slug" => $slug]);
        if (empty($c)) 
        {
            throw new HttpException(404, "Slug ou type non existant.");
        }

        return $this->render('competence-detail.html.twig', [
            'c' => $c,
        ] + BaseController::getBase($m)); 
    }
}


