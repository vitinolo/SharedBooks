<?php

namespace App\Controller;
use App\Repository\BookRepository; 
use App\Repository\GenderRepository; 
use App\Repository\LibraryRepository; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LibraryController extends AbstractController
{
    #[Route('/', name: 'app_library')]
    public function index(LibraryRepository $repo): Response
    {
        $library = $repo->findBy([], ['createdAt' => 'DESC'], 10);
        return $this->render('library/library.html.twig', [
            'library' => $library
        ]);
    }
}

class GenderController extends AbstractController
{
    #[Route('/gender', name: 'app_gender')]
    public function index(GenderRepository $repo): Response 
    {
        return $this->render('gender/gender.html.twig', [
            'gender' => $gender
        ]);
    }
}
class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(BookRepository $repo): Response 
    {
        return $this->render('book/book.html.twig', [
            'book' => $book
        ]);
    }
}