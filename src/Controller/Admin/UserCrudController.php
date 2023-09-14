<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\config\Action;
use EasyCorp\Bundle\EasyAdminBundle\config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->onlyOnIndex(),
            TextField::new('email'),
            $roles= ChoiceField::new('roles')->setColumns('col-md-4')->setChoices([
                'ROLE_USER'=>'ROLE_USER',
                'ROLE_EDITOR'=>'ROLE_EDITOR',
                'ROLE_ADMIN'=>'ROLE_ADMIN',
                ])->allowMultipleChoices(),
            TextField::new('firstname'),
            TextField::new('lastname'),       
        ];
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
        ->setPermission(Action::DELETE, 'ROLE_ADMIN');
    }
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
        ->add('firstname')
        ->add('lastname')
        ->add('createdAt')
        ;
    }
   
}
