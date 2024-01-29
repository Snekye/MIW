<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\LocaleDto;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\EntityManagerInterface;

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
    #[Route('/admin/{_locale}', name: 'admin')]
    public function index(): Response
    {
        return $this->render("admin/admin.html.twig", [
            'user' => $this->getUser(),
        ]);
    }
    #[Route('/admin', name: 'admin-nolocale')]
    public function index2(): Response
    {
        return $this->redirectToRoute('admin', ['_locale' => 'fr']);
    }

    private $manager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->manager = $entityManager;
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('MIW-Admin')
            ->setFaviconPath('img/admin-icon.png')
            ->setTextDirection('ltr')

            ->renderContentMaximized()

            ->setTranslationDomain('admin')
            ->setLocales([
                'fr' => 'French 🇫🇷',
                'en' => 'English 🇬🇧',
            ])
        ;
    }
    
    public function configureMenuItems(): iterable
    {
        $msgNotifs = count($this->manager->getRepository(Contact::class)->findBy(['_read' => false]));
        $msgNotifs = $msgNotifs == 0 ? null : $msgNotifs;
        return [
            MenuItem::linkToRoute('ea.dashboard.home', 'fa fa-home', 'home'),
            MenuItem::linkToDashboard('ea.dashboard.admin', 'fa fa-star'),

            MenuItem::section('ea.dashboard.admin_section')
                ->setPermission('ROLE_ADMIN'),
            MenuItem::linkToCrud('ea.dashboard.users', 'fa fa-circle-user', AdminUser::class)
                ->setPermission('ROLE_ADMIN')
                ->setController(AdminUserCrudController::class),
            MenuItem::linkToCrud('ea.dashboard.roles', 'fa fa-pen', AdminUserRole::class)
                ->setPermission('ROLE_ADMIN'),
            MenuItem::linkToCrud("ea.dashboard.config", 'fa fa-gear', InfoConfig::class)
                ->setPermission('ROLE_ADMIN'),
            MenuItem::subMenu('ea.dashboard.messages.list', 'fa fa-folder')->setSubItems([
                MenuItem::linkToCrud("ea.dashboard.messages.contact", 'fa fa-comment', Contact::class)
                    ->setBadge($msgNotifs,'danger'),
                MenuItem::linkToCrud("ea.dashboard.messages.access_logs", 'fa fa-folder', AdminAccessLog::class),
                MenuItem::linkToCrud("ea.dashboard.messages.logs", 'fa fa-folder', AdminLog::class)
                    ->setDefaultSort(["id" => "DESC"]),
                ])
                ->setBadge($msgNotifs,'danger')
                ->setPermission('ROLE_ADMIN'),
            
            MenuItem::section('ea.dashboard.edit_section'),
            MenuItem::subMenu('ea.dashboard.content.list', 'fa fa-paper-plane')->setSubItems([
                MenuItem::linkToCrud("ea.dashboard.content.news", 'fa fa-newspaper', AccueilActualite::class),
                MenuItem::linkToCrud("ea.dashboard.content.skills", 'fa fa-bolt', Competence::class),
                MenuItem::linkToCrud("ea.dashboard.content.service_fees", 'fa fa-wrench', PresentationDepannageTarif::class),
                MenuItem::linkToCrud("ea.dashboard.content.shift_fees", 'fa fa-truck', PresentationDepannageTarifDeplacement::class),
                MenuItem::linkToCrud("ea.dashboard.content.partners", 'fa fa-paperclip', PresentationPartenaire::class),
                MenuItem::linkToCrud("ea.dashboard.content.hiring", 'fa fa-user', PresentationRecrutementPoste::class),
                MenuItem::linkToCrud("ea.dashboard.content.projects", 'fa fa-clipboard', Projet::class),
                MenuItem::linkToCrud("ea.dashboard.content.socials", 'fa-brands fa-facebook', Reseau::class),
                MenuItem::linkToCrud("ea.dashboard.content.tags", 'fa fa-tags', Tag::class),
                ]),

            MenuItem::subMenu('ea.dashboard.blog.list', 'fa fa-cloud')->setSubItems([
                MenuItem::linkToCrud("ea.dashboard.blog.articles", 'fa fa-blog', BlogArticle::class),
                MenuItem::linkToCrud("ea.dashboard.blog.comments", 'fa fa-comments', BlogCommentaire::class),
                MenuItem::linkToCrud("ea.dashboard.blog.themes", 'fa fa-wand-magic-sparkles', BlogTheme::class),
                ]),
        ];
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->displayUserAvatar(false)
            ->addMenuItems([
                MenuItem::linkToCrud('ea.dashboard.profile', 'fa fa-id-card', AdminUser::class)
                    ->setController(AdminUserProfileController::class)
                    ->setAction('edit')
                    ->setEntityId($user->getId()),
            ]);
    }
}
