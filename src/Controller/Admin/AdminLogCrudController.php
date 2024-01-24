<?php

namespace App\Controller\Admin;

use App\Entity\AdminLog;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

use Symfony\Contracts\Translation\TranslatorInterface;

class AdminLogCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AdminLog::class;
    }

    private $t;
    public function __construct(TranslatorInterface $translator)
    {
        $this->t = $translator;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index',$this->t->trans('ea.adminlog.title.index', domain: 'admin'))
            ->setPageTitle('detail',$this->t->trans('ea.adminlog.title.detail', domain: 'admin'))

            ->setEntityLabelInSingular('ea.adminlog.entity.singular')
            ->setEntityLabelInPlural('ea.adminlog.entity.plural')

            ->setSearchFields(['user_login.login'])
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateField::new('date','ea.adminlog.label.date')
                ->setFormat('EEE d MMM y HH:mm:ss')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            ChoiceField::new('action','ea.adminlog.label.action')
                ->setChoices([
                    "Create" => "Create",
                    "Update" => "Update",
                    "Delete" => "Delete"
                ]),
            'message',
            AssociationField::new('user_login','ea.adminlog.label.userlogin')
                ->autocomplete(),
        ];
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX,Action::NEW)
            ->remove(Crud::PAGE_INDEX,Action::EDIT)
            ->remove(Crud::PAGE_INDEX,Action::DELETE)

            ->setPermission('index','ROLE_ADMIN')
        ;
    }
}
