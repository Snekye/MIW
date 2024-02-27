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
    public const ARTICLE_PPG = 1; // nb d'articles par page.

    #[Route('/blog', name: 'blog')]
    public function blog_home(EntityManagerInterface $m) 
    {
        return $this->blog($m, null, null, 1);
    }

    #[Route('/blog/{page}', name: 'blog-page')]
    public function blog(EntityManagerInterface $m, string $tag = null, string $theme = null, int $page): Response
    {
        $q = $m->getRepository(BlogArticle::class)->createQueryBuilder('a');

        // if (!is_null($tag) && !is_null($theme)) {
        //     $queryBuilder->where(':tag MEMBER OF a.tags OR a.theme = :theme')
        //         ->setParameter('tag', $tag)
        //         ->setParameter('theme', $theme);
        // } elseif (!is_null($tag)) {

        if (!is_null($tag)) {
            $q  ->where(':tag MEMBER OF a.tags')
                ->setParameter('tag', $tag);
            $count = $m->getRepository(BlogArticle::class)->count(["tag" => $tag]);
        } elseif (!is_null($theme)) {
            $q  ->where('a.theme = :theme')
                ->setParameter('theme', $theme);
            $count = $m->getRepository(BlogArticle::class)->count(["theme" => $theme]);
        }
        else {
            $count = $m->getRepository(BlogArticle::class)->count([]);
        }

        $q->orderBy('a._created','DESC');
        $q->setFirstResult(($page-1)*$this::ARTICLE_PPG);
        $q->setMaxResults($this::ARTICLE_PPG);

        $articles = $q->getQuery()->getResult();

        if (empty($articles)) 
        {
            throw new HttpException(404, "Page ou type non existant.");
        }
        $lastpage = ceil($count / $this::ARTICLE_PPG);

        return $this->render('blog.html.twig', [
            'articles' => $articles,
            'themes' => $m->getRepository(BlogTheme::class)->findAll(),
            'tags' => $m->getRepository(Tag::class)->findAll(),
            'page' => $page,
            'lastpage' => $lastpage,
            'tag' => $tag,
            'theme' => $theme,
        ] + BaseController::getBase($m));
    }
    #[Route('/blog/tag/{tag}', name: 'blog-tag')]
    public function blog_tag(EntityManagerInterface $m, string $tag): Response
    {
        return $this->blog($m, $tag, null);
    }
    #[Route('/blog/theme/{theme}', name: 'blog-theme')]
    public function blog_theme(EntityManagerInterface $m, string $theme): Response
    {
        return $this->blog($m, null, $theme);
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