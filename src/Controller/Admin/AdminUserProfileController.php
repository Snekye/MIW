<?php

namespace App\Controller\Admin;

use App\Entity\AdminUser;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

use Symfony\Contracts\Translation\TranslatorInterface;

class AdminUserProfileController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AdminUser::class;
    }

    private $t;
    public function __construct(TranslatorInterface $translator)
    {   
        $this->t = $translator;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('edit',$this->t->trans('ea.profile.title', domain: 'admin'))
        ;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('login','ea.adminuser.label.login'),
            TextField::new('email','ea.adminuser.label.email'),
        ];
    }
}
