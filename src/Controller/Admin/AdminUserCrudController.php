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
            ->setPageTitle('index','ea.adminuser.title.index')
            ->setPageTitle('new','ea.adminuser.title.new')
            ->setPageTitle('edit','ea.adminuser.title.edit')
            ->setPageTitle('detail','ea.adminuser.title.detail')

            ->setEntityLabelInSingular('ea.adminuser.entity.singular')
            ->setEntityLabelInPlural('ea.adminuser.entity.plural')

            ->setSearchFields(['login'])
        ;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('login','ea.adminuser.label.login'),
            TextField::new('password','ea.adminuser.label.password')
                ->hideOnIndex()
                ->hideOnDetail()
                ->hideWhenUpdating(),
            TextField::new('email','ea.adminuser.label.email'),
            AssociationField::new('role','ea.adminuser.label.role')
                ->autocomplete(),

            AssociationField::new('_created','ea.adminuser.label.created')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            AssociationField::new('_updated','ea.adminuser.label.updated')
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
