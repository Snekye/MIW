<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\LocaleDto;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\AdminUser;
use App\Entity\AdminUserRole;
use App\Entity\AdminAccessLog;
use App\Entity\AdminLog;
use App\Entity\BlogArticle;
use App\Entity\BlogCommentaire;
use App\Entity\BlogTheme;
use App\Entity\Contact;
use App\Entity\InfoConfig;

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

            // set this option if you prefer the page content to span the entire
            // browser width, instead of the default design which sets a max width
            ->renderContentMaximized()

            // set this option if you prefer the sidebar (which contains the main menu)
            // to be displayed as a narrow column instead of the default expanded design
            //->renderSidebarMinimized()

            // by default, all backend URLs are generated as absolute URLs. If you
            // need to generate relative URLs instead, call this method
            //->generateRelativeUrls()

            // set this option if you want to enable locale switching in dashboard.
            // IMPORTANT: this feature won't work unless you add the {_locale}
            // parameter in the admin dashboard URL (e.g. '/admin/{_locale}').
            // the name of each locale will be rendered in that locale
            // (in the following example you'll see: "English", "Polski")
            //->setLocales(['en', 'pl'])

            // to customize the labels of locales, pass a key => value array
            // (e.g. to display flags; although it's not a recommended practice,
            // because many languages/locales are not associated to a single country)

            //->setLocales([
            //    'en' => '🇬🇧 English',
            //    'pl' => '🇵🇱 Polski'
            //])

            // to further customize the locale option, pass an instance of
            // EasyCorp\Bundle\EasyAdminBundle\Config\Locale
            // ->setLocales([
            //     'en', // locale without custom options
            //     Locale::new('pl', 'polski', 'far fa-language') // custom label and icon
            // ])
        ;
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToRoute('Retour au site', 'fa fa-home', ''),
            MenuItem::linkToDashboard('Menu admin', 'fa fa-star'),

            MenuItem::section('Admin'),
            MenuItem::linkToCrud('Utilisateurs', 'fa fa-circle-user', AdminUser::class),
            MenuItem::linkToCrud('Rôles', 'fa fa-pen', AdminUserRole::class),
            MenuItem::linkToCrud("Infos et config", 'fa fa-gear', InfoConfig::class),

            MenuItem::section('Messages & Logs'),
            MenuItem::linkToCrud("Messagerie", 'fa fa-comment', Contact::class),
            MenuItem::linkToCrud("Logs d'accès", 'fa fa-folder', AdminAccessLog::class),
            MenuItem::linkToCrud("Logs d'actions", 'fa fa-folder', AdminLog::class),
            

            MenuItem::section('Public'),

            MenuItem::section('Blog'),
            MenuItem::linkToCrud("Articles", 'fa fa-blog', BlogArticle::class),
            MenuItem::linkToCrud("Commentaires", 'fa fa-comments', BlogCommentaire::class),
            MenuItem::linkToCrud("Thèmes", 'fa fa-wand-magic-sparkles', BlogTheme::class),
        ];
    }
}
