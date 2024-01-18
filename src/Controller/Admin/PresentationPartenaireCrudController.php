<?php

namespace App\Controller\Admin;

use App\Entity\PresentationPartenaire;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class PresentationPartenaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PresentationPartenaire::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index','Partenaires')
            ->setPageTitle('new',"Ajout d'un partenaire")
            ->setPageTitle('edit',"Modification de partenaire")
            ->setPageTitle('detail',"Détail du partenaire")

            ->setEntityLabelInSingular('partenaire')
            ->setEntityLabelInPlural('partenaires')
        ;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            AssociationField::new('image')
        ];
    }
}
