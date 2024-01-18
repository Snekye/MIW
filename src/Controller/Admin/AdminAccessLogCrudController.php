<?php

namespace App\Controller\Admin;

use App\Entity\AdminAccessLog;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Text;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class AdminAccessLogCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AdminAccessLog::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index',"Logs d'accès")
            ->setPageTitle('detail',"Log")

            ->setEntityLabelInSingular('log')
            ->setEntityLabelInPlural('logs')

            ->setSearchFields(['user_login.login'])
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            DateField::new('date')
                ->setFormat('EEE d MMM y HH:mm')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            'success',
            AssociationField::new('user_login')
                ->autocomplete(),
        ];
    }
}
