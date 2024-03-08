<?php

namespace App\Controller\Admin;

use App\Entity\BlogArticle;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Contracts\Translation\TranslatorInterface;

use App\Admin\Field\TinyMCEField;

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

            ->setSearchFields(['titre','titre_slug','theme.lib'])
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
            TinyMCEField::new('contenu'),
            AssociationField::new('theme'),
            TextField::new('imageFile')
                ->setFormType(VichImageType::class),
            AssociationField::new('tags')
                ->setCrudController(TagCrudController::class)
                ->autocomplete(),

            AssociationField::new('_created','ea.common.created')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            AssociationField::new('_updated','ea.common.updated')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
        ];
    }
}
