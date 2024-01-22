<?php

namespace App\Controller\Admin;

use App\Entity\AdminUserRole;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

class AdminUserRoleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AdminUserRole::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index','Rôles utilisateur')
            ->setPageTitle('new',"Ajout d'un rôle")
            ->setPageTitle('edit',"Modification d'un rôle")
            ->setPageTitle('detail',"Détail du rôle")

            ->setEntityLabelInSingular('rôle')
            ->setEntityLabelInPlural('rôles')

            ->setSearchFields(['lib'])
        ;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('lib'),
            TextField::new('code'),
            NumberField::new('niveau'),

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
        ;
    }
}
