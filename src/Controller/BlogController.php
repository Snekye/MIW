<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\BlogArticle;
use App\Entity\BlogTheme;
use App\Entity\Tag;
use App\Controller\BaseController;

class BlogController extends AbstractController
{
    public const ARTICLE_PPG = 5; // nb d'articles par page.

    #[Route('/blog', name: 'blog')]
    public function blog_home(EntityManagerInterface $m) 
    {
        return $this->blog($m, null, null, 1);
    }

    #[Route('/blog/{page}', name: 'blog-page')]
    public function blog(EntityManagerInterface $m, string $tag = null, string $theme = null, int $page): Response
    {
        // Note : ce controller à été chatgptisé. Faire foncionner les filtres et la pagination en même temps 
        // est une tâche digne d'un héros grec et je n'ai eu aucun succès malgré plusieurs méthodes
        // (changements d'ordres d'opérations, utilisation du doctrine Criteria, etc.) ; c'est donc pourquoi la solution finale
        // consiste à appliquer la pagination manuellement. Cela convidendra très bien pour cette utilisation mais sur une table 
        // de milliers d'éléments ne pas appliquer la pagination en BDD à un gros coût.
        $qb = $m->getRepository(BlogArticle::class)->createQueryBuilder('a');

        if (!is_null($tag)) {
            $qb->join('a.tags', 't')
                ->andWhere(':tag = t.lib')
                ->setParameter('tag', $tag);
        } elseif (!is_null($theme)) {
            $qb->join('a.theme', 'th')
                ->andWhere(':theme = th.lib')
                ->setParameter('theme', $theme);
        }

        $qb->orderBy('a._created', 'DESC');
        $articles_temp = $qb->getQuery()->getResult();
        $lastpage = ceil(count($articles_temp) / $this::ARTICLE_PPG);

        $articles = array_slice($articles_temp, ($page - 1) * $this::ARTICLE_PPG, $this::ARTICLE_PPG);

        if (empty($articles)) {
            throw new HttpException(404, "Page ou type non existant.");
        }


        return $this->render('blog.html.twig', [
            'articles' => $paginatedArticles,
            'themes' => $m->getRepository(BlogTheme::class)->findAll(),
            'tags' => $m->getRepository(Tag::class)->findAll(),
            'page' => $page,
            'lastpage' => $lastpage,
            'tag' => $tag,
            'theme' => $theme,
        ] + BaseController::getBase($m));
    }


    #[Route('/blog/tag/{tag}', name: 'blog-tag')]
    public function blog_tag_home(EntityManagerInterface $m, string $tag): Response
    {
        return $this->blog($m, $tag, null, 1);
    }
    #[Route('/blog/theme/{theme}', name: 'blog-theme')]
    public function blog_them_home(EntityManagerInterface $m, string $theme): Response
    {
        return $this->blog($m, null, $theme, 1);
    }
    #[Route('/blog/tag/{tag}/{page}', name: 'blog-tag-page')]
    public function blog_tag(EntityManagerInterface $m, string $tag, int $page): Response
    {
        return $this->blog($m, $tag, null, $page);
    }
    #[Route('/blog/theme/{theme}/{page}', name: 'blog-theme-page')]
    public function blog_theme(EntityManagerInterface $m, string $theme, int $page): Response
    {
        return $this->blog($m, null, $theme, $page);
    }


    #[Route('/blog/article/{slug}', name: 'blog-article')]
    public function blog_article(EntityManagerInterface $m, string $slug): Response
    {
        $a = $m->getRepository(BlogArticle::class)->findOneBy(["titre_slug" => $slug]);
        if (empty($a)) 
        {
            throw new HttpException(404, "Slug non existant.");
        }

        return $this->render('blog-article.html.twig', [
            'a' => $a,
            'themes' => $m->getRepository(BlogTheme::class)->findAll(),
            'tags' => $m->getRepository(Tag::class)->findAll(),
        ] + BaseController::getBase($m));
    }
}