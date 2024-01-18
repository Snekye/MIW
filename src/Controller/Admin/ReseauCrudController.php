<?php

namespace App\Controller\Admin;

use App\Entity\Reseau;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class ReseauCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reseau::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index','Réseaux sociaux')
            ->setPageTitle('new',"Ajout d'un réseau")
            ->setPageTitle('edit',"Modification de réseau")
            ->setPageTitle('detail',"Détail du réseau")

            ->setEntityLabelInSingular('réseau')
            ->setEntityLabelInPlural('réseaux')
        ;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('lib'),
            TextField::new('lien'),
            AssociationField::new('image')
        ];
    }
}
