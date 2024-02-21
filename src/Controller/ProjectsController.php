<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Projet;
use App\Controller\BaseController;

class ProjectsController extends AbstractController
{
    public const PROJECT_PPG = 5; // nb de projets par page.

    #[Route('/projets-{type}', name: 'projets')]
    public function projets_home(EntityManagerInterface $m, string $type): Response
    {
        return $this->projets($m, 1, $type);
    }
    #[Route('/projets-{type}/{page}', name: 'projets-page')]
    public function projets(EntityManagerInterface $m, int $page, string $type): Response
    {
        $projects = $m->getRepository(Projet::class)->findBy(["type" => $type], [], $this::PROJECT_PPG, ($page-1)*$this::PROJECT_PPG); //recherche, filtre, limit, offset
        if (empty($projects)) 
        {
            throw new HttpException(404, "Slug ou type non existant.");
        }
        $count = $m->getRepository(Projet::class)->count(["type" => $type]);
        $lastpage = ceil($count / $this::PROJECT_PPG);

        return $this->render('projects.html.twig', [
            'type' => $type,
            'projects' => $projects,
            'page' => $page,
            'lastpage' => $lastpage,
        ] + BaseController::getBase($m));
    }
    #[Route('/projets-{type}/detail/{slug}', name: 'projet-detail')]
    public function projets_detail(EntityManagerInterface $m, string $type, string $slug): Response
    {
        $p = $m->getRepository(Projet::class)->findOneBy(["titre_slug" => $slug]);
        if (empty($p)) 
        {
            throw new HttpException(404, "Slug ou type non existant.");
        }

        return $this->render('project-detail.html.twig', [
            'type' => $type,
            'p' => $p,
        ] + BaseController::getBase($m));
    }
}