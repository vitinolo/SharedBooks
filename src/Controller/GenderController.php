<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GenderController extends AbstractController
{
    #[Route('/gender', name: 'app_gender')]
    public function index(): Response
    {
        return $this->render('gender/gender.html.twig', [
            'controller_name' => 'GenderController',
        ]);
    }
}
