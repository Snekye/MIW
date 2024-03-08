<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\BlogArticle;
use App\Entity\BlogCommentaire;
use App\Entity\BlogTheme;
use App\Entity\Tag;
use App\Controller\BaseController;
use App\Form\CommentType;

class BlogController extends AbstractController
{
    public const ARTICLE_PPG = 5; // nb d'articles par page.

    #[Route('/blog', name: 'blog')]
    public function blog_home(EntityManagerInterface $m) 
    {
        return $this->blog($m, null, null, null, 1);
    }

    #[Route('/blog/{page}', name: 'blog-page')]
    public function blog(EntityManagerInterface $m, string $date = null, string $tag = null, string $theme = null, int $page): Response
    {
        // Note : ce controller à été chatgptisé. Faire foncionner les filtres et la pagination en même temps 
        // est une tâche digne d'un héros grec et je n'ai eu aucun succès malgré plusieurs méthodes
        // (changements d'ordres d'opérations, utilisation du doctrine Criteria, etc.) ; c'est donc pourquoi la solution finale
        // consiste à appliquer la pagination manuellement. Cela convidendra très bien pour cette utilisation mais sur une table 
        // de milliers d'éléments ne pas appliquer la pagination en BDD à un gros coût.
        
        
        $qb = $m->getRepository(BlogArticle::class)->createQueryBuilder('a');
        $route = 'blog-page'; // définit la route de redirection pour les boutons page précédente/suivante
        $filter = null; // permet d'afficher le filtre actuallement utilisé

        if (!is_null($tag)) {
            $qb->join('a.tags', 't')
                ->andWhere(':tag = t.lib')
                ->setParameter('tag', $tag);
            $route = 'blog-tag-page';
            $filter = 'Tag: ' . $tag;
        } elseif (!is_null($theme)) {
            $qb->join('a.theme', 'th')
                ->andWhere(':theme = th.lib')
                ->setParameter('theme', $theme);
            $route = 'blog-theme-page';
            $filter = 'Theme: '. $theme;
        } elseif (!is_null($date)) {
            $qb->andWhere('a.date LIKE :date')
                ->setParameter('date', $date.'-%');
            $route = 'blog-date-page';
            $filter = 'Date: du 01/'.substr($date,5,2).'/'.substr($date,0,4).' au 31/'.substr($date,5,2).'/'.substr($date,0,4);
        }

        $qb->orderBy('a.date', 'DESC');
        $articles_temp = $qb->getQuery()->getResult();
        $lastpage = ceil(count($articles_temp) / $this::ARTICLE_PPG);

        //pagination manuelle
        $articles = array_slice($articles_temp, ($page - 1) * $this::ARTICLE_PPG, $this::ARTICLE_PPG);

        if (empty($articles)) {
            throw new HttpException(404, "Page ou type non existant.");
        }

        return $this->render('blog.html.twig', [
            'articles' => $articles,
            'themes' => $m->getRepository(BlogTheme::class)->findAll(),
            'tags' => $m->getRepository(Tag::class)->findAll(),
            'dates' => $this::getDates($m),
            'page' => $page,
            'lastpage' => $lastpage,
            'tag' => $tag,
            'theme' => $theme,
            'date' => $date,
            'route' => $route,
            'filter' => $filter,
        ] + BaseController::getBase($m));
    }

    //Routes filtres ----------------------------------------------------------------
    #[Route('/blog/date/{date}', name: 'blog-date')]
    public function blog_date_home(EntityManagerInterface $m, string $date): Response
    {
        return $this->blog($m, $date, null, null, 1);
    }
    #[Route('/blog/tag/{tag}', name: 'blog-tag')]
    public function blog_tag_home(EntityManagerInterface $m, string $tag): Response
    {
        return $this->blog($m, null, $tag, null, 1);
    }
    #[Route('/blog/theme/{theme}', name: 'blog-theme')]
    public function blog_them_home(EntityManagerInterface $m, string $theme): Response
    {
        return $this->blog($m, null, null, $theme, 1);
    }
    
    // Routes filtres + dates ----------------------------------------------------------------
    #[Route('/blog/date/{date}/{page}', name: 'blog-date-page')]
    public function blog_date(EntityManagerInterface $m, string $date, int $page): Response
    {
        return $this->blog($m, $date, null, null, $page);
    }
    #[Route('/blog/tag/{tag}/{page}', name: 'blog-tag-page')]
    public function blog_tag(EntityManagerInterface $m, string $tag, int $page): Response
    {
        return $this->blog($m, null, $tag, null, $page);
    }
    #[Route('/blog/theme/{theme}/{page}', name: 'blog-theme-page')]
    public function blog_theme(EntityManagerInterface $m, string $theme, int $page): Response
    {
        return $this->blog($m, null, null, $theme, $page);
    }

    // Route détail -------------------------------------------------------------------------
    #[Route('/blog/article/{slug}', name: 'blog-article')]
    public function blog_article(Request $r, EntityManagerInterface $m, string $slug): Response
    {
        $a = $m->getRepository(BlogArticle::class)->findOneBy(["titre_slug" => $slug]);
        if (empty($a)) 
        {
            throw new HttpException(404, "Slug non existant.");
        }

        // commentaires

        $comment = new BlogCommentaire();

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($r);

        $msg = null;
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $comment->setArticle($a);

                $m->persist($comment);
                $m->flush();

                $msg = 'Success!';
            }
            else {
                $msg = 'Error!';
            }
        }


        return $this->render('blog-article.html.twig', [
            'a' => $a,
            'themes' => $m->getRepository(BlogTheme::class)->findAll(),
            'tags' => $m->getRepository(Tag::class)->findAll(),
            'dates' => $this::getDates($m),
            'form' => $form,
            'msg' => $msg,
        ] + BaseController::getBase($m));
    }

    // ----------------------------------------------------------------
    public function getDates(EntityManagerInterface $m) {
        //On sort les dates de leurs arrays et on les filtres pour obtenir des mois uniques
        $dates_temp = $m->createQuery(
            'SELECT DISTINCT a.date as d
            FROM App\Entity\BlogArticle a
            ORDER BY a.date DESC'
        )->getResult();
        $dates = [];
        $dates_checker = [];
        foreach ($dates_temp as $d) {
            if (!isset($dates_checker[$d['d']->format('Y-m')]))
            {
                $dates_checker[] = $d['d']->format('Y-m');
                $dates[] = $d['d'];
            }
        }
        return $dates;
    }
}