<?php

namespace App\Controller\Admin;

use App\Entity\Reseau;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class ReseauCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reseau::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index','Réseaux sociaux')
            ->setPageTitle('new',"Ajout d'un réseau")
            ->setPageTitle('edit',"Modification de réseau")
            ->setPageTitle('detail',"Détail du réseau")

            ->setEntityLabelInSingular('réseau')
            ->setEntityLabelInPlural('réseaux')

            ->setSearchFields(['lib'])
        ;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('lib'),
            TextField::new('lien'),
            ImageField::new('image')
                ->setUploadDir('public/img/upload/Reseau')
                ->setBasePath('img/upload/Reseau')
                ->setUploadedFileNamePattern('[year]-[month]-[day]-[contenthash].[extension]'),

            AssociationField::new('_created')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            AssociationField::new('_updated')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
        ];
    }
}
