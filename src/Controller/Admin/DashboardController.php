<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\LocaleDto;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

use App\Entity\AccueilActualite;
use App\Entity\AdminUser;
use App\Entity\AdminUserRole;
use App\Entity\AdminAccessLog;
use App\Entity\AdminLog;
use App\Entity\BlogArticle;
use App\Entity\BlogCommentaire;
use App\Entity\BlogTheme;
use App\Entity\Contact;
use App\Entity\Competence;
use App\Entity\InfoConfig;
use App\Entity\PresentationDepannageTarif;
use App\Entity\PresentationDepannageTarifDeplacement;
use App\Entity\PresentationPartenaire;
use App\Entity\PresentationRecrutementPoste;
use App\Entity\Projet;
use App\Entity\Reseau;
use App\Entity\Tag;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render("admin/admin.html.twig");
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('MIW-Admin')
            ->setFaviconPath('img/admin-icon.png')
            ->setTextDirection('ltr')

            ->renderContentMaximized()

            ->setLocales([
                'fr' => 'French 🇫🇷',
                'en' => 'English 🇬🇧',
            ])
        ;
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToRoute('Retour au site', 'fa fa-home', 'home'),
            MenuItem::linkToDashboard('Menu admin', 'fa fa-star'),

            MenuItem::section('Administration'),
            MenuItem::linkToCrud('Utilisateurs', 'fa fa-circle-user', AdminUser::class),
            MenuItem::linkToCrud('Rôles', 'fa fa-pen', AdminUserRole::class),
            MenuItem::linkToCrud("Infos et config", 'fa fa-gear', InfoConfig::class),
            MenuItem::subMenu('Messages & Logs', 'fa fa-folder')->setSubItems([
                MenuItem::linkToCrud("Messagerie", 'fa fa-comment', Contact::class),
                MenuItem::linkToCrud("Logs d'accès", 'fa fa-folder', AdminAccessLog::class),
                MenuItem::linkToCrud("Logs d'actions", 'fa fa-folder', AdminLog::class),
            ]),
        
            MenuItem::section(),
            MenuItem::subMenu('Contenu', 'fa fa-paper-plane')->setSubItems([
                MenuItem::linkToCrud("Actualités", 'fa fa-newspaper', AccueilActualite::class),
                MenuItem::linkToCrud("Compétences", 'fa fa-bolt', Competence::class),
                MenuItem::linkToCrud("Tarifs dépannages", 'fa fa-wrench', PresentationDepannageTarif::class),
                MenuItem::linkToCrud("Tarifs déplacement", 'fa fa-truck', PresentationDepannageTarifDeplacement::class),
                MenuItem::linkToCrud("Partenaires", 'fa fa-paperclip', PresentationPartenaire::class),
                MenuItem::linkToCrud("Recrutement", 'fa fa-user', PresentationRecrutementPoste::class),
                MenuItem::linkToCrud("Projets", 'fa fa-clipboard', Projet::class),
                MenuItem::linkToCrud("Réseaux", 'fa-brands fa-facebook', Reseau::class),
                MenuItem::linkToCrud("Tags", 'fa fa-tags', Tag::class),
            ]),

            MenuItem::subMenu('Blog', 'fa fa-cloud')->setSubItems([
                MenuItem::linkToCrud("Articles", 'fa fa-blog', BlogArticle::class),
                MenuItem::linkToCrud("Commentaires", 'fa fa-comments', BlogCommentaire::class),
                MenuItem::linkToCrud("Thèmes", 'fa fa-wand-magic-sparkles', BlogTheme::class),
            ]),
        ];
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->addMenuItems([
                MenuItem::linkToRoute('Profil', 'fa fa-id-card', '...', ['...' => '...']),
                MenuItem::linkToRoute('Paramètres', 'fa fa-user-cog', '...', ['...' => '...']),
                MenuItem::section(),
                MenuItem::linkToLogout('Logout', 'fa fa-sign-out'),
            ]);
    }
}
