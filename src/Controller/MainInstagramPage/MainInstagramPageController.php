<?php

declare(strict_types=1);

namespace App\Controller\MainInstagramPage;

use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainInstagramPageController extends AbstractController
{
    /**
     * @var \App\Repository\PostRepository $postRepository
     */
    private PostRepository $postRepository;

    /**
     * @var \App\Repository\UserRepository
     */
    private UserRepository $userRepository;

    /**
     * @var bool
     */
    public bool $heartImageStatus;

    /**
     * @param PostRepository $postRepository
     * @param UserRepository $userRepository
     */
    public function __construct(PostRepository $postRepository,  UserRepository $userRepository)
    {
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
    }

    #[Route('/', name: 'app_main_instagram_page')]
    /**
     * @param Request $request
     * 
     * @return Response
     */
    public function index(Request $request): Response
    {
        $heartImageStatus = $request->get('heartImageStatus');
        if ($heartImageStatus == true) {
        } else {
            $heartImageStatus = false;
        }
        return $this->render('MainInstagramPage/index.html.twig', [
            'posts' => $this->postRepository->findAll(),
            'heartImageStatus' => $heartImageStatus ? 'images/heartOn.PNG' : 'images/heartOff.PNG',
            'users' => $this->userRepository->findAll()
        ]);
    }
}
