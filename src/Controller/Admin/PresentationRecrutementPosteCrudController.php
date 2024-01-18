<?php

namespace App\Controller\Admin;

use App\Entity\PresentationRecrutementPoste;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class PresentationRecrutementPosteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PresentationRecrutementPoste::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index','Offres de recrutement')
            ->setPageTitle('new',"Ajout d'une offre")
            ->setPageTitle('edit',"Modification d'offre")
            ->setPageTitle('detail',"Détail d'offre")

            ->setEntityLabelInSingular('offre')
            ->setEntityLabelInPlural('offres')

            ->setSearchFields(['lib'])
        ;
    }
}
