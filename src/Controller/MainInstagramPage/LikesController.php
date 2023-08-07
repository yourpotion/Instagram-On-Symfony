<?php

declare(strict_types=1);

namespace App\Controller\MainInstagramPage;

use App\Service\LikesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class LikesController extends AbstractController
{
    /**
     * @var bool
     */
    public bool $heartImageStatus;

    /**
     * @var LikesService
     */
    private LikesService $likeService;

    public function __construct(LikesService $likeService)
    {
        $this->likeService = $likeService;
    }

    #[Route('/post/{postId}', methods: ['GET'], name: 'main_with_id')]
    /**
     * @param int $postId
     * 
     * @return Response
     */
    public function addLikeToPost(int $postId): Response
    {
        $currentUser = $this->getUser();
        $heartImageStatus = $this->likeService->toggleLike($postId, $currentUser);

        return $this->redirectToRoute('app_main_instagram_page', [
            'heartImageStatus' => $heartImageStatus ? 'images/heartOn.PNG' : 'images/heartOff.PNG'
        ]);
    }
}
