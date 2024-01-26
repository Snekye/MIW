<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\AccueilActualite;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(EntityManagerInterface $m): Response
    {
        return $this->render('home.html.twig', [
            'news' => $m->getRepository(AccueilActualite::class)->findBy([],["id" => "DESC"],1,0)
        ] + BaseController::getBase($m));
    }
}