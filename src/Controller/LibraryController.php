<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository; 
use App\Repository\GenderRepository; 
use App\Repository\LibraryRepository; 
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LibraryController extends AbstractController
{   
  //affichage des livres de façon fluide
    #[Route('/', name: 'app_book')]
    public function index(BookRepository $repo): Response
    {
        
        $book = $repo->findBy([], ['createdAt' => 'DESC'], 1);
        $book1 = $repo->findBy([], ['createdAt' => 'DESC'], 1,1);
        $book2 = $repo->findBy([], ['createdAt' => 'DESC'], 1,2);
        $book3 = $repo->findBy([], ['createdAt' => 'DESC'], 3,3);
        $book4 = $repo->findBy([], ['createdAt' => 'DESC'], 3,6);
        $book5 = $repo->findBy([], ['createdAt' => 'DESC'], 3,9);
        return $this->render('book/book.html.twig', [
            'book' => $book,
            'book1'=> $book1,
            'book2'=> $book2,
            'book3'=> $book3,
            'book4'=> $book4,
            'book5'=> $book5,
        ]);
    }

    //affichage d'un livre
    #[Route('/{id}', name: 'showone', requirements:['id'=>'\d+'])]
    public function showOne($id, BookRepository $repo, EntityManagerInterface $em ){
      //1. récupèrer la librairie à afficher en utilisant l'id
      $book = $repo->find($id);
      //2. vérifier si le livre existe
      if(!$book){
        throw $this->createNotFoundException('le livre demandé n\existe pas');
      } 
      //3. on retourne la vue portant détail du livre
      return $this->render('shows/show.html.twig',[
        'book'=> $book,
      ]);
    }

}


