<?php

namespace App\Controller\Admin;

use App\Entity\AccueilActualite;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class AccueilActualiteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AccueilActualite::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index','Actualités')
            ->setPageTitle('new',"Ajout d'une actualité")
            ->setPageTitle('edit',"Modification d'actualité")
            ->setPageTitle('detail',"Détail de l'actualité")

            ->setEntityLabelInSingular('actualité')
            ->setEntityLabelInPlural('actualités')

            ->setSearchFields(['titre', 'titre_slug'])
        ;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            DateField::new('date')
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->setFormat('EEE d MMM y'),
            TextField::new('titre'),
            TextField::new('titre_slug')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            TextEditorField::new('contenu'),
            ImageField::new('image')
                ->setUploadDir('public/img/upload/AccueilActualite')
                ->setUploadedFileNamePattern('[year]-[month]-[day]-[contenthash].[extension]'),
        ];
    }
    
}
