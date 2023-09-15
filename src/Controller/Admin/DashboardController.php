<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Book;
use App\Entity\Gender;
use App\Entity\Library;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
       //fixer le rôle le moins élévé
       if($this->isGranted('ROLE_EDITOR')){
        return $this->render('admin/dashboard.html.twig');
        }else
        return $this->redirectToRoute('app_library');

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SharedBooks');
    }

    public function configureMenuItems(): iterable
    {   
        yield MenuItem::linkToRoute('Go to site', 'fa-solid fa-arrow-rotate-left','app_library');
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        
        if ($this->isGranted('ROLE_EDITOR')){
            yield MenuItem::section('Libraries');
            yield MenuItem::subMenu('Libraries', 'fa-solid fa-book-journal-whills')->setSubItems([
                MenuItem::linkToCrud('Create Library', 'fas fa-plus-circle', Library::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Show Library', 'fas fa-eye', Library::class),
            ]);
        }
        if ($this->isGranted('ROLE_EDITOR')){
            yield MenuItem::section('Books');
            yield MenuItem::subMenu('Books', 'fa-solid fa-book')->setSubItems([
                MenuItem::linkToCrud('Create Book', 'fas fa-plus-circle', Book::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Show Book', 'fas fa-eye', Book::class),
            ]);
        }
        if ($this->isGranted('ROLE_ADMIN')){
            yield MenuItem::section('Users');
            yield MenuItem::subMenu('Users', 'fa fa-user-circle')->setSubItems([
                MenuItem::linkToCrud('Create User', 'fas fa-plus-circle', User::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Show User', 'fas fa-eye', User::class),
            ]);
        }
        if ($this->isGranted('ROLE_ADMIN')){
            yield MenuItem::section('Genders');
            yield MenuItem::subMenu('Genders', 'fa-solid fa-sort')->setSubItems([
                MenuItem::linkToCrud('Create Gender', 'fas fa-plus-circle', Gender::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Show Gender', 'fas fa-eye', Gender::class),
            ]);
        }
    }
}