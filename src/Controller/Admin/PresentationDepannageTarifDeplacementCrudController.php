<?php

namespace App\Controller\Admin;

use App\Entity\PresentationDepannageTarifDeplacement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class PresentationDepannageTarifDeplacementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PresentationDepannageTarifDeplacement::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index','Tarifs de déplacement')
            ->setPageTitle('new',"Ajout d'un tarif")
            ->setPageTitle('edit',"Modification de tarif")
            ->setPageTitle('detail',"Détail du tarif")

            ->setEntityLabelInSingular('tarif')
            ->setEntityLabelInPlural('tarifs')

            ->setSearchFields(['lib','tarif'])
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('lib'),
            NumberField::new('prix'),

            AssociationField::new('_created')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            AssociationField::new('_updated')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
        ];
    }
}
