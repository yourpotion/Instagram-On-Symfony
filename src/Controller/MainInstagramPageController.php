<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainInstagramPageController extends AbstractController
{
    #[Route('/', name: 'app_main_instagram_page')]
    public function index(): Response
    {
        return $this->render('MainInstagramPage/index.html.twig');
    }
    #[Route('/create', name: 'create_movie')]
    public function create(): Response
    {
        return $this->render('MainInstagramPage/index.html.twig');
    }
}
