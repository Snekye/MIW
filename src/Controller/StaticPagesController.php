<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;

use App\Controller\BaseController;

class StaticPagesController extends AbstractController
{
    // Présentation ----------------------------------------------------------------
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

    // Web ----------------------------------------------------------------
    #[Route('/creation-graphique', name: 'creation-graphique')]
    public function creation_graphique(EntityManagerInterface $m): Response
    {
        return $this->render('creation-graphique.html.twig', BaseController::getBase($m));
    }

    #[Route('/creation-site', name: 'creation-site')]
    public function creation_site(EntityManagerInterface $m): Response
    {
        return $this->render('creation-site.html.twig', BaseController::getBase($m));
    }

    #[Route('/referencement', name: 'referencement')]
    public function referencement(EntityManagerInterface $m): Response
    {
        return $this->render('referencement.html.twig', BaseController::getBase($m));
    }

    #[Route('/hebergement', name: 'hebergement')]
    public function hebergement(EntityManagerInterface $m): Response
    {
        return $this->render('hebergement.html.twig', BaseController::getBase($m));
    }

    #[Route('/formules', name: 'formules')]
    public function formules(EntityManagerInterface $m): Response
    {
        return $this->render('formules.html.twig', BaseController::getBase($m));
    }

    // Informatique ----------------------------------------------------------------
    #[Route('/competences', name: 'competences')]
    public function competences(EntityManagerInterface $m): Response
    {
        return $this->render('competences.html.twig', BaseController::getBase($m));
    }

    #[Route('/assistance', name: 'assistance')]
    public function assistance(EntityManagerInterface $m): Response
    {
        return $this->render('assistance.html.twig', BaseController::getBase($m));
    }

    #[Route('/maintenance', name: 'maintenance')]
    public function maintenance(EntityManagerInterface $m): Response
    {
        return $this->render('maintenance.html.twig', BaseController::getBase($m));
    }

    #[Route('/location', name: 'location')]
    public function location(EntityManagerInterface $m): Response
    {
        return $this->render('location.html.twig', BaseController::getBase($m));
    }

    #[Route('/externalisation', name: 'externalisation')]
    public function externalisation(EntityManagerInterface $m): Response
    {
        return $this->render('externalisation.html.twig', BaseController::getBase($m));
    }

    #[Route('/vente-materiel', name: 'vente-materiel')]
    public function vente_materiel(EntityManagerInterface $m): Response
    {
        return $this->render('vente-materiel.html.twig', BaseController::getBase($m));
    }

    #[Route('/infogerance', name: 'infogerance')]
    public function infogerance(EntityManagerInterface $m): Response
    {
        return $this->render('infogerance.html.twig', BaseController::getBase($m));
    }

    #[Route('/vente-solutions', name: 'vente-solutions')]
    public function vente_solutions(EntityManagerInterface $m): Response
    {
        return $this->render('vente-solutions.html.twig', BaseController::getBase($m));
    }

    // ----------------------------------------------------------------
    #[Route('/mentions', name: 'mentions')]
    public function mentions(EntityManagerInterface $m): Response
    {
        return $this->render('mentions.html.twig', BaseController::getBase($m));
    }

    #[Route('/confidentialite', name: 'confidentialite')]
    public function confidentialite(EntityManagerInterface $m): Response
    {
        return $this->render('confidentialite.html.twig', BaseController::getBase($m));
    }
}
