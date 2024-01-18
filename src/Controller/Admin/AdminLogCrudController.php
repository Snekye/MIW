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
                ->setFormat('EEE d MMM y HH:mm')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            ChoiceField::new('action')
                ->setChoices([
                    "Ajout" => "Ajout",
                    "Modification" => "Modification",
                    "Suppression" => "Suppression"
                ]),
            'cible_table',
            'cible_id',
            AssociationField::new('user_login')
                ->autocomplete(),
        ];
    }
}
