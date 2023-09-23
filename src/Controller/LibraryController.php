<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository; 
use App\Repository\KindRepository; 
use App\Repository\LibraryRepository; 
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LibraryController extends AbstractController
{   
  //route et affichage des livres (accueil) de façon fluide
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

    //route et affichage d'un livre
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

    //route et affichage des librairies
    #[Route('/libraries', name: 'library')]
    public function library(LibraryRepository $repo): Response
    {
        
        $library = $repo->findBy([], ['createdAt' => 'DESC'], 1);
        $library1 = $repo->findBy([], ['createdAt' => 'DESC'], 1,1);
        $library2 = $repo->findBy([], ['createdAt' => 'DESC'], 1,2);
        $library3 = $repo->findBy([], ['createdAt' => 'DESC'], 3,3);
        $library4 = $repo->findBy([], ['createdAt' => 'DESC'], 3,6);
        $library5 = $repo->findBy([], ['createdAt' => 'DESC'], 3,9);
        return $this->render('libraries/libraries.html.twig', [
            'library' => $library,
            'library1'=> $library1,
            'library2'=> $library2,
            'library3'=> $library3,
            'library4'=> $library4,
            'library5'=> $library5,
        ]);
    }

    // Route pour la recherche de bibliothèque par nom
    #[Route('/search/library', name: 'search_library')]
    public function searchLibrary(Request $request, LibraryRepository $libraryRepository): Response
    {
        $libraryName = $request->query->get('library_name');

        // Utilisez le Repository pour rechercher des bibliothèques par nom
        $libraries = $libraryRepository->findByName($libraryName);

        return $this->render('showlibrary/findOneLibrary.html.twig', [
            'libraries' => $libraries,
            'search_query' => $libraryName,
        ]);
    }
  
    // route et affichage des livres d'une librairie
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
        $library1 = $libraryRepository->findBy([], ['createdAt' => 'DESC']);
        $library2 = $libraryRepository->findBy([], ['createdAt' => 'DESC']);
        $library3 = $libraryRepository->findBy([], ['createdAt' => 'DESC']);
        $library4 = $libraryRepository->findBy([], ['createdAt' => 'DESC']);
        $library5 = $libraryRepository->findBy([], ['createdAt' => 'DESC']);
        return $this->render('showlibrary/showlibraryBooks.html.twig', [
            'library' => $library,
            'library1' => $library1,
            'library2' => $library2,
            'library3' => $library3,
            'library4' => $library4,
            'library5' => $library5,
            'books' => $books,
        ]);
    }

    //route et affichage des livres par genre
    #[Route('/kind', name: 'kind')]
    public function kind( BookRepository $repo): Response
    {
        // Récupérer les genres associés aux livres
        $kinds = $repo->findBy(['fkkinds'=>'1'], [], 4);
        $kinds1 = $repo->findBy(['fkkinds'=>'2'], [], 4);
        $kinds2 = $repo->findBy(['fkkinds'=>'3'], [], 4);
        return $this->render('kind/kind.html.twig', [
            'kinds' => $kinds,
            'kinds1' => $kinds1,
            'kinds2' => $kinds2,
            
        ]);
    }
    
    #[Route('/search-books-by-kind', name: 'search_books_by_kind')]
    public function searchBooksByKind(Request $request, KindRepository $repo): Response
    {
        // Récupérer le nom du genre depuis la requête GET
        $kindName = $request->query->get('kind_name');

        // Rechercher les livres par genre
        $books = $repo->findAll( ['fkkinds'],$kindName);

        return $this->render('kind/allBooksKind.html.twig', [
            'books' => $books,
            'search_query' => $kindName,
        ]);
    }
    
    //route et affichage du about
    #[Route('/about', name: 'about')]
    public function about(): Response{
        return $this->render('about/about.html.twig');
    }

}


