<?php

namespace App\Controller\Admin;

use App\Entity\InfoConfig;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class InfoConfigCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return InfoConfig::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index','Configuration et informations générales')
            ->setPageTitle('new',"Ajout d'une valeur")
            ->setPageTitle('edit',"Modification d'une valeur")
            ->setPageTitle('detail',"Détail d'une valeur")

            ->setEntityLabelInSingular('valeur')
            ->setEntityLabelInPlural('valeurs')

            ->setSearchFields(['lib','valeur'])
        ;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('lib'),
            TextField::new('valeur'),

            AssociationField::new('_created')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            AssociationField::new('_updated')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
        ];
    }
}
