<?php

namespace App\Controller\Admin;

use App\Entity\Projet;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class ProjetCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Projet::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index','Projets')
            ->setPageTitle('new',"Ajout d'un projet")
            ->setPageTitle('edit',"Modification de projet")
            ->setPageTitle('detail',"Détail du projet")

            ->setEntityLabelInSingular('projet')
            ->setEntityLabelInPlural('projets')
        ;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            TextField::new('titre_slug')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            TextField::new('sous_titre'),
            TextField::new('description_courte'),
            TextField::new('description'),
            TextField::new('type'),
        ];
    }
}
