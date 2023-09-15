<?php

namespace App\Controller\Admin;

use App\Entity\Library;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LibraryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Library::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->onlyOnIndex(),
            TextField::new('name'),
            TextField::new('nblivre'),
            DateField::new('createdAt')->onlyOnIndex(),
        ];
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
        ->setPermission(Action::DELETE, 'ROLE_EDITOR');
    }
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
        ->add('name')
        ;
    }
   
}