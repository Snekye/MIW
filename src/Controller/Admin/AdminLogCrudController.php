<?php

namespace App\Controller\Admin;

use App\Entity\AdminLog;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

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

            ->setDateTimeFormat('EEE d MMM y HH:mm');
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            'date',
            'action',
            'cible_table',
            'cible_id',
            AssociationField::new('user_login')
                ->autocomplete(),
        ];
    }
}
