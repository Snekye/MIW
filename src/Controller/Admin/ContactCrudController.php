<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index','Messages')
            ->setPageTitle('detail',"Message")

            ->setEntityLabelInSingular('message')
            ->setEntityLabelInPlural('messages')

            ->setSearchFields(['nom','prenom','email','entreprise'])
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            DateField::new('date')
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->setFormat('EEE d MMM y HH:mm'),
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('entreprise'),
            TextField::new('ville'),
            TextField::new('email'),
            TextField::new('tel'),
            TextEditorField::new('contenu'),
            BooleanField::new('_read'),
        ];
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX,Action::NEW)
            ->remove(Crud::PAGE_INDEX,Action::EDIT)
            ->remove(Crud::PAGE_INDEX,Action::DELETE)
        ;
    }
}
