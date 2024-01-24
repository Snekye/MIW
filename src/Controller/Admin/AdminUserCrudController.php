<?php

namespace App\Controller\Admin;

use App\Entity\AdminUser;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

use Symfony\Contracts\Translation\TranslatorInterface;

class AdminUserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AdminUser::class;
    }

    private $t;
    public function __construct(TranslatorInterface $translator)
    {
        $this->t = $translator;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index',$this->t->trans('ea.adminuser.title.index', domain: 'admin'))
            ->setPageTitle('new',$this->t->trans('ea.adminuser.title.new', domain: 'admin'))
            ->setPageTitle('edit',$this->t->trans('ea.adminuser.title.edit', domain: 'admin'))
            ->setPageTitle('detail',$this->t->trans('ea.adminuser.title.detail', domain: 'admin'))

            ->setEntityLabelInSingular('ea.adminuser.entity.singular')
            ->setEntityLabelInPlural('ea.adminuser.entity.plural')

            ->setSearchFields(['login'])
        ;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('login','ea.adminuser.label.login'),
            TextField::new('password','ea.adminuser.label.password')
                ->hideOnIndex()
                ->hideOnDetail()
                ->hideWhenUpdating(),
            TextField::new('email','ea.adminuser.label.email'),
            AssociationField::new('role','ea.adminuser.label.role')
                ->autocomplete(),

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

            ->setPermission('new','ROLE_SUPERADMIN')
            ->setPermission('edit','ROLE_SUPERADMIN')
            ->setPermission('delete','ROLE_SUPERADMIN')
        ;
    }
}
