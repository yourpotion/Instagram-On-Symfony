<?php

declare(strict_types=1);

namespace App\Controller\MainInstagramPage;

use App\Service\FollowService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FollowController extends AbstractController
{
    /**
     * @var FollowService
     */
    private FollowService $followService;

    /**
     * @param FollowService $followService
     */
    public function __construct(FollowService $followService) 
    {
        $this->followService = $followService;
    }


    #[Route('/follow/{userId}',  name: 'main_add_follower')]
    /**
     * @param int $userId
     * 
     * @return Response
     */
    public function addFollowerToUser(int $userId): Response
    {
        $userWhoFollow = $this->getUser();

        $this->followService->toggleFollow($userId, $userWhoFollow);

        return $this->redirectToRoute('app_main_instagram_page');
    }
}
