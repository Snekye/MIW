<?php

namespace App\Controller\Admin;

use App\Entity\AdminUser;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

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
            IdField::new('id')->hideOnForm(),
            TextField::new('login'),
            TextField::new('email'),
            AssociationField::new('role')
                ->autocomplete(),
        ];
    }
}
