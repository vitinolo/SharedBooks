<?php

namespace App\Controller\Admin;

use App\Entity\Kind;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class KindCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Kind::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->onlyOnIndex(),
            TextField::new('name'),      
        ];
    }
    
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
        ->add('name')
        ;
    }
   
}
