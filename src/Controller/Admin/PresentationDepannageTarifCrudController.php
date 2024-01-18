<?php

namespace App\Controller\Admin;

use App\Entity\PresentationDepannageTarif;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class PresentationDepannageTarifCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PresentationDepannageTarif::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index','Tarifs de dépannage')
            ->setPageTitle('new',"Ajout d'un tarif")
            ->setPageTitle('edit',"Modification de tarif")
            ->setPageTitle('detail',"Détail du tarif")

            ->setEntityLabelInSingular('tarif')
            ->setEntityLabelInPlural('tarifs')
        ;
    }
}
