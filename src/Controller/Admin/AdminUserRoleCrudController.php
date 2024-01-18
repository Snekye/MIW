<?php

namespace App\Controller\Admin;

use App\Entity\AdminUserRole;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

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
}
