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

class AdminLogCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AdminLog::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index',"Logs d'action")
            ->setPageTitle('detail',"Log")

            ->setEntityLabelInSingular('log')
            ->setEntityLabelInPlural('logs')

            ->setSearchFields(['user_login.login'])
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateField::new('date')
                ->setFormat('EEE d MMM y HH:mm:ss')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            ChoiceField::new('action')
                ->setChoices([
                    "Create" => "Create",
                    "Update" => "Update",
                    "Delete" => "Delete"
                ]),
            'message',
            AssociationField::new('user_login')
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
