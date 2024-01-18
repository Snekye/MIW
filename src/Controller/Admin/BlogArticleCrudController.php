<?php

namespace App\Controller\Admin;

use App\Entity\BlogArticle;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class BlogArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BlogArticle::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index','Articles de blog')
            ->setPageTitle('new',"Ajout d'article")
            ->setPageTitle('edit',"Modification d'article")
            ->setPageTitle('detail',"Détail de l'article")

            ->setEntityLabelInSingular('article')
            ->setEntityLabelInPlural('articles')
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
            AssociationField::new('theme'),
            AssociationField::new('image')
        ];
    }
}
