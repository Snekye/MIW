<?php

namespace App\Controller\Admin;

use App\Entity\Projet;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

use Vich\UploaderBundle\Form\Type\VichImageType;
use App\Form\ImageType;
use Doctrine\ORM\EntityManagerInterface;

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

            ->setSearchFields(['titre','titre_slug'])
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
            AssociationField::new('tags')
                ->setCrudController(TagCrudController::class)
                ->autocomplete(),
            ChoiceField::new('type')
                ->setChoices([
                    "Projet web" => "web",
                    "Projet print" => "print",
                ]),
            TextEditorField::new('description_courte'),
            TextEditorField::new('description'),
            CollectionField::new('images')
                ->setEntryType(ImageType::class)
                ->onlyOnForms(),

            AssociationField::new('_created')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            AssociationField::new('_updated')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
        ];
    }
}
