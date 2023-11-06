<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\Form\Extension\Core\Type\FileType;

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
            TextField::new('firstname'),
            TextField::new('lastname'),
            /* Textfield::new('avatar')->setFormType(FileType::class)->onlyWhenCreating(),
            ImageField::new('avatar')->setBasePath('/divers/avatars')->onlyOnIndex(), */
            ImageField::new('avatar')
            ->setUploadDir('public/divers/avatars')
            ->setBasePath('divers/avatars')
            ->setSortable(false)
            ->setFormTypeOption('required', false),
            TextField::new('email'),
            TextField::new('password'),       
            $roles= ChoiceField::new('roles')->setColumns('col-md-4')->setChoices([
                'ROLE_USER'=>'ROLE_USER',
                'ROLE_EDITOR'=>'ROLE_EDITOR',
                'ROLE_ADMIN'=>'ROLE_ADMIN',
                ])->allowMultipleChoices(),
        ];
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
        ->setPermission(Action::DELETE, 'ROLE_ADMIN')
        ->setPermission(Action::EDIT, 'ROLE_ADMIN');
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
