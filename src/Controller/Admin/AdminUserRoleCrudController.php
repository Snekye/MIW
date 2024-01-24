<?php

namespace App\Controller\Admin;

use App\Entity\AdminUserRole;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

use Symfony\Contracts\Translation\TranslatorInterface;

class AdminUserRoleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AdminUserRole::class;
    }

    private $t;
    public function __construct(TranslatorInterface $translator)
    {
        $this->t = $translator;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index',$this->t->trans('ea.adminuserrole.title.index', domain: 'admin'))
            ->setPageTitle('new',$this->t->trans('ea.adminuserrole.title.new', domain: 'admin'))
            ->setPageTitle('edit',$this->t->trans('ea.adminuserrole.title.edit', domain: 'admin'))
            ->setPageTitle('detail',$this->t->trans('ea.adminuserrole.title.detail', domain: 'admin'))

            ->setEntityLabelInSingular('ea.adminuserrole.entity.singular')
            ->setEntityLabelInPlural('ea.adminuserrole.entity.plural')

            ->setSearchFields(['lib'])
        ;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('lib','ea.adminuserrole.label.label'),
            TextField::new('code','ea.adminuserrole.label.code'),
            NumberField::new('niveau','ea.adminuserrole.label.level'),

            AssociationField::new('_created','ea.common.created')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            AssociationField::new('_updated','ea.common.updated')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
        ];
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->setPermission('index','ROLE_ADMIN')
        ;
    }
}
