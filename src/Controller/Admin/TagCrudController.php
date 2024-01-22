<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class TagCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tag::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index','Tags')
            ->setPageTitle('new',"Ajout d'un tag")
            ->setPageTitle('edit',"Modification de tag")
            ->setPageTitle('detail',"Détail du tag")

            ->setEntityLabelInSingular('tag')
            ->setEntityLabelInPlural('tags')

            ->setSearchFields(['lib'])
        ;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('lib'),

            AssociationField::new('_created')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            AssociationField::new('_updated')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
        ];
    }
}
