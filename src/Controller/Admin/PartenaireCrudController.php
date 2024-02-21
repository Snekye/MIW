<?php

namespace App\Controller\Admin;

use App\Entity\Partenaire;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PartenaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Partenaire::class;
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

            ->setSearchFields(['nom'])
        ;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('imageFile')
                ->setFormType(VichImageType::class),
            AssociationField::new('_created')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            AssociationField::new('_updated')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
        ];
    }
}
