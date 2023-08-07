<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Follower;
use App\Entity\Following;
use App\Repository\FollowerRepository;
use App\Repository\FollowingRepository;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;

class FollowService
{
    /**
     * @var \App\Repository\UserRepository
     */
    private UserRepository $userRepository;

    /**
     * @var \App\Repository\FollowingRepository $followingRepository
     */
    private FollowingRepository $followingRepository;

    /**
     * @var \App\Repository\FollowerRepository $followerRepository
     */
    private FollowerRepository $followerRepository;


    /**
     * @param UserRepository $userRepository
     * @param FollowingRepository $followingRepository
     * @param FollowerRepository $followerRepository
     */
    public function __construct(UserRepository $userRepository, FollowingRepository $followingRepository, FollowerRepository $followerRepository)
    {
        $this->userRepository = $userRepository;
        $this->followingRepository = $followingRepository;
        $this->followerRepository = $followerRepository;
    }

    /**
     * @param int $userId
     * 
     * @param UserInterface $userWhoFollow
     * 
     * @return void
     */
    public function toggleFollow(int $userId, UserInterface $userWhoFollow): void
    {
        $userFollowOn = $this->userRepository->find($userId);

        $isFollowingByCurrentUser = $userFollowOn->getFollowings()->filter(function ($following) use ($userWhoFollow) {
            return $following->getUser() === $userWhoFollow;
        })->count() > 0;

        if (!$isFollowingByCurrentUser) {

            $following = new Following();
            $follower = new Follower(); //($this-followerRepository->find($id)) - для другого варианта


            $follower->setUser($userFollowOn);
            $following->setUser($userWhoFollow);

            $following->setFollower($follower->getUser());

            $userFollowOn->addFollower($follower);

            $this->followerRepository->save($follower);
            $this->followingRepository->save($following);
        } else {
            $existingFollowing = $userFollowOn->getFollowings()->filter(function ($following) use ($userWhoFollow) {
                return $following->getUser() === $userWhoFollow;
            })->first();

            if ($existingFollowing) {

                $userFollowOn->removeFollowing($existingFollowing);
                $this->followingRepository->remove($existingFollowing);
            }
        }
    }
}
