<?php

namespace App\Controller\Admin;

use App\Entity\Competence;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class CompetenceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Competence::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index','Compétences')
            ->setPageTitle('new',"Ajout d'une compétence")
            ->setPageTitle('edit',"Modification de compétence")
            ->setPageTitle('detail',"Détail de la compétence")

            ->setEntityLabelInSingular('compétence')
            ->setEntityLabelInPlural('compétences')

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
            TextField::new('contenu'),
            ImageField::new('image')
                ->setUploadDir('public/img/upload/Competence')
                ->setBasePath('img/upload/Competence')
                ->setUploadedFileNamePattern('[year]-[month]-[day]-[contenthash].[extension]'),
        ];
    }
}
