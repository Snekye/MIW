<?php

namespace App\Controller\Admin;

use App\Entity\AdminUser;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

class AdminUserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AdminUser::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index','Utilisateurs')
            ->setPageTitle('new',"Ajout d'utilisateur")
            ->setPageTitle('edit',"Modification d'utilisateur")
            ->setPageTitle('detail',"Détail de l'utilisateur")

            ->setEntityLabelInSingular('utilisateur')
            ->setEntityLabelInPlural('utilisateurs')

            ->setSearchFields(['login'])
        ;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('login'),
            TextField::new('password')
                ->hideOnIndex()
                ->hideOnDetail()
                ->hideWhenUpdating(),
            TextField::new('email'),
            AssociationField::new('role')
                ->autocomplete(),

            AssociationField::new('_created')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            AssociationField::new('_updated')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
        ];
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->setPermission('index','ROLE_ADMIN')

            ->setPermission('new','ROLE_SUPERADMIN')
            ->setPermission('edit','ROLE_SUPERADMIN')
            ->setPermission('delete','ROLE_SUPERADMIN')
        ;
    }
}
