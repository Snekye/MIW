<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\News;

class NewsController extends AbstractController
{
    #[Route('/news', name: 'news')]
    public function news(EntityManagerInterface $m): Response
    {
        return $this->render('news.html.twig', [
            'news' => $m->getRepository(News::class)->findBy([],["id" => "DESC"]),
        ] + BaseController::getBase($m));
    }

    #[Route('/news/{slug}', name: 'news-detail')]
    public function news_detail(EntityManagerInterface $m, string $slug): Response
    {
        return $this->render('news-detail.html.twig', [
            'news' => $m->getRepository(News::class)->findBy(['titre_slug' => $slug], null),
        ] + BaseController::getBase($m));
    }
}