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
  //affichage des livres (accueil) de façon fluide
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

    //afficahge des librairies
    #[Route('/library', name: 'library')]
    public function library(LibraryRepository $repo): Response
    {
        
        $library = $repo->findBy([], ['createdAt' => 'DESC'], 1);
        $library1 = $repo->findBy([], ['createdAt' => 'DESC'], 1,1);
        $library2 = $repo->findBy([], ['createdAt' => 'DESC'], 1,2);
        $library3 = $repo->findBy([], ['createdAt' => 'DESC'], 3,3);
        $library4 = $repo->findBy([], ['createdAt' => 'DESC'], 3,6);
        $library5 = $repo->findBy([], ['createdAt' => 'DESC'], 3,9);
        return $this->render('library/library.html.twig', [
            'library' => $library,
            'library1'=> $library1,
            'library2'=> $library2,
            'library3'=> $library3,
            'library4'=> $library4,
            'library5'=> $library5,
        ]);
    }
    //affichage des livres d'une librairie
    #[Route('/library/{id}', name: 'library_detail', requirements: ['id' => '\d+'])]
    public function showLibraryBooks($id, LibraryRepository $libraryRepository): Response
    {
        // Récupérer la bibliothèque par son ID
        $library = $libraryRepository->find($id);

        // Vérifier si la bibliothèque existe
        if (!$library) {
          throw $this->createNotFoundException('La bibliothèque demandée n\'existe pas.');
        }
        
        // Récupérer les livres associés à cette bibliothèque
        $books = $library->getBooks();
        
        // Vérifier si la collection de livres est vide
        if (!$books) {
          // Gérer le cas où la bibliothèque n'a pas de livre
          return $this->render('library/empty_library.html.twig', [
              'library' => $library,
          ]);
        } 
        // Afficher la vue avec les livres de la bibliothèque
        $library1 = $libraryRepository->findAll([], ['createdAt' => 'DESC']);
        $library2 = $libraryRepository->findAll([], ['createdAt' => 'DESC']);
        $library3 = $libraryRepository->findAll([], ['createdAt' => 'DESC']);
        $library4 = $libraryRepository->findAll([], ['createdAt' => 'DESC']);
        $library5 = $libraryRepository->findAll([], ['createdAt' => 'DESC']);
        return $this->render('showlibrary/showlibrary.html.twig', [
            'library' => $library,
            'library1' => $library1,
            'library2' => $library2,
            'library3' => $library3,
            'library4' => $library4,
            'library5' => $library5,
            'books' => $books,
        ]);
    }

    //affichage des livres par genre
    #[Route('/gender', name: 'gender')]
    public function gender( BookRepository $repo): Response
    {
        // Récupérer les genres associés aux livres
        $genders = $repo->findBy(['fkgenders'=>'1'], [], 4);
        $genders1 = $repo->findBy(['fkgenders'=>'2'], [], 4);
        $genders2 = $repo->findBy(['fkgenders'=>'3'], [], 4);
        return $this->render('gender/gender.html.twig', [
            'genders' => $genders,
            'genders1' => $genders1,
            'genders2' => $genders2,
            
        ]);
    }

}


