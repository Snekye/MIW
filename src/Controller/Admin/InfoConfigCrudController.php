<?php

namespace App\Controller\Admin;

use App\Entity\InfoConfig;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

use Symfony\Contracts\Translation\TranslatorInterface;

class InfoConfigCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return InfoConfig::class;
    }

    private $t;
    public function __construct(TranslatorInterface $translator)
    {
        $this->t = $translator;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index',$this->t->trans('ea.infoconfig.title.index', domain: 'admin'))
            ->setPageTitle('new',$this->t->trans('ea.infoconfig.title.new', domain: 'admin'))
            ->setPageTitle('edit',$this->t->trans('ea.infoconfig.title.edit', domain: 'admin'))
            ->setPageTitle('detail',$this->t->trans('ea.infoconfig.title.detail', domain: 'admin'))

            ->setEntityLabelInSingular('ea.infoconfig.entity.singular')
            ->setEntityLabelInPlural('ea.infoconfig.entity.plural')

            ->setSearchFields(['lib','valeur'])
        ;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('lib','ea.infoconfig.label.label'),
            TextField::new('valeur','ea.infoconfig.label.value'),

            AssociationField::new('_created','ea.common.created')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            AssociationField::new('_updated','ea.common.updated')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
        ];
    }
}
