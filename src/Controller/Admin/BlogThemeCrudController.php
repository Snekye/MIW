<?php

namespace App\Controller\Admin;

use App\Entity\BlogTheme;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class BlogThemeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BlogTheme::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index','Thèmes de blog')
            ->setPageTitle('new',"Ajout d'un thème")
            ->setPageTitle('edit',"Modification d'un thème")
            ->setPageTitle('detail',"Détail du thème")

            ->setEntityLabelInSingular('thème')
            ->setEntityLabelInPlural('thèmes')

            ->setSearchFields(['lib'])
        ;
    }
}
