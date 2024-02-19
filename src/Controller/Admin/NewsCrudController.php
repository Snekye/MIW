<?php

namespace App\Controller\Admin;

use App\Entity\News;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Contracts\Translation\TranslatorInterface;

class NewsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return News::class;
    }

    private $t;
    public function __construct(TranslatorInterface $translator)
    {
        $this->t = $translator;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index',$this->t->trans('ea.news.title.index', domain: 'admin'))
            ->setPageTitle('new',$this->t->trans('ea.news.title.new', domain: 'admin'))
            ->setPageTitle('edit',$this->t->trans('ea.news.title.edit', domain: 'admin'))
            ->setPageTitle('detail',$this->t->trans('ea.news.title.detail', domain: 'admin'))

            ->setEntityLabelInSingular('ea.news.entity.singular')
            ->setEntityLabelInPlural('ea.news.entity.plural')

            ->setSearchFields(['titre', 'titre_slug'])
        ;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            DateField::new('date','ea.news.label.date')
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->setFormat('EEE d MMM y'),
            TextField::new('titre','ea.news.label.title'),
            TextField::new('titre_slug','ea.news.label.titleslug')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            TextEditorField::new('contenu','ea.news.label.content'),
            TextField::new('imageFile')
                ->setFormType(VichImageType::class),
                
            AssociationField::new('_created','ea.common.created')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            AssociationField::new('_updated','ea.common.updated')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
        ];
    }
    
}
