<?php

namespace App\Controller\Admin;

use App\Entity\BlogCommentaire;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

class BlogCommentaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BlogCommentaire::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index','Commentaires de blog')
            ->setPageTitle('detail',"Détail du commentaire")

            ->setEntityLabelInSingular('commentaire')
            ->setEntityLabelInPlural('commentaires')

            ->setSearchFields(['nom','email','article.titre','article.titre_slug'])
        ;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('email'),
            TextEditorField::new('contenu'),
            AssociationField::new('article'),
        ];
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX,Action::NEW)
        ;
    }
}
