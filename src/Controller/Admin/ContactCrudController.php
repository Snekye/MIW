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

use Symfony\Contracts\Translation\TranslatorInterface;

use App\Admin\Field\TinyMCEField;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    private $t;
    public function __construct(TranslatorInterface $translator)
    {
        $this->t = $translator;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index',$this->t->trans('ea.contact.title.index', domain: 'admin'))
            ->setPageTitle('detail',$this->t->trans('ea.contact.title.index', domain: 'admin'))

            ->setSearchFields(['nom','prenom','email','entreprise'])
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            DateField::new('date','ea.contact.label.date')
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->setFormat('EEE d MMM y HH:mm'),
            TextField::new('nom','ea.contact.label.lastname'),
            TextField::new('prenom','ea.contact.label.firstname'),
            TextField::new('entreprise','ea.contact.label.company'),
            TextField::new('ville','ea.contact.label.city'),
            TextField::new('email','ea.contact.label.email'),
            TextField::new('tel','ea.contact.label.phone'),
            TinyMCEField::new('contenu','ea.contact.label.content'),
            BooleanField::new('_read','ea.contact.label.read'),
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
