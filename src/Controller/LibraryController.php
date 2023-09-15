<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LibraryController extends AbstractController
{
    #[Route('/', name: 'app_library')]
    public function index(): Response
    {
        return $this->render('library/library.html.twig', [
            'controller_name' => 'LibraryController',
        ]);
    }
}
