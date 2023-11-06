<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Book;
use App\Entity\Kind;
use App\Entity\Library;
use App\Entity\Comment;
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
        return $this->redirectToRoute('app_book');

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SharedBooks');
    }

    public function configureMenuItems(): iterable
    {   
        yield MenuItem::linkToRoute('Go to site', 'fa-solid fa-arrow-rotate-left','app_book');
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        
        if ($this->isGranted('ROLE_EDITOR')){
            yield MenuItem::section('Librairies');
            yield MenuItem::subMenu('Librairies', 'fa-solid fa-book-journal-whills')->setSubItems([
                MenuItem::linkToCrud('Créer Librairie', 'fas fa-plus-circle', Library::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Voir Librairies', 'fas fa-eye', Library::class),
            ]);
        }
        if ($this->isGranted('ROLE_EDITOR')){
            yield MenuItem::section('Livres');
            yield MenuItem::subMenu('Livres', 'fa-solid fa-book')->setSubItems([
                MenuItem::linkToCrud('Créer Livre', 'fas fa-plus-circle', Book::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Voir Livres', 'fas fa-eye', Book::class),
            ]);
        }
        if ($this->isGranted('ROLE_ADMIN')){
            yield MenuItem::section('Utilisateurs');
            yield MenuItem::subMenu('Utilisateurs', 'fa fa-user-circle')->setSubItems([
                MenuItem::linkToCrud('Créer Utilisateur', 'fas fa-plus-circle', User::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Voir Utilisateurs', 'fas fa-eye', User::class),
            ]);
        }
        if ($this->isGranted('ROLE_ADMIN')){
            yield MenuItem::section('Genres');
            yield MenuItem::subMenu('Genres', 'fa-solid fa-sort')->setSubItems([
                MenuItem::linkToCrud('Créer Genre', 'fas fa-plus-circle', Kind::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Voir Genres', 'fas fa-eye', Kind::class),
            ]);
        }
        if ($this->isGranted('ROLE_ADMIN')){
            yield MenuItem::section('Commentaires');
            yield MenuItem::subMenu('Commentaires', 'fa-solid fa-comment')->setSubItems([
                  MenuItem::linkToCrud('Voir Commentaires', 'fas fa-eye', Comment::class),
            ]);
        }
    }
}
