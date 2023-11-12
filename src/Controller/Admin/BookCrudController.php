<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BookCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Book::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->onlyOnIndex(),
            AssociationField::new('fklibraries'),
            AssociationField::new('fkkinds'),
            TextField::new('isbn'),
            TextField::new('title'),
            TextField::new('author'),
            TextField::new('nb_pages'),
            TextField::new('editor'),
            $image = ImageField::new('book_cover')
            ->setUploadDir('public/divers/images')
            ->setBasePath('divers/images')
            ->setSortable(false)
            ->setFormTypeOption('required',false)->setColumns('col-md-2'),
            TextField::new('description'),
            DateField::new('createdAt')->onlyOnIndex(),
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
        ->add('isbn')
        ->add('title')
        ->add('author')
        ->add('editor')
        ->add('fkkinds')
        ;
    }
   
}
