<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\PostUserLikes;
use App\Repository\PostRepository;
use App\Repository\PostUserLikesRepository;
use Symfony\Component\Security\Core\User\UserInterface;

class LikesService 
{
    /**
     * @var \App\Repository\PostRepository $postRepository
     */
    private PostRepository $postRepository;

    /**
     * @var \App\Repository\PostUserLikesRepository $postUserLikesRepository
     */
    private PostUserLikesRepository $postUserLikesRepository;

    /**
     * @var bool
     */
    public bool $heartImageStatus;

    /**
     * @param PostRepository $postRepository
     * @param PostUserLikesRepository $postUserLikesRepository
     */
    public function __construct(PostRepository $postRepository, PostUserLikesRepository $postUserLikesRepository)
    {
        $this->postRepository = $postRepository;
        $this->postUserLikesRepository = $postUserLikesRepository;
    }


    /**
     * @param int $postId
     * @param UserInterface $currentUser
     * 
     * @return bool
     */
    public function toggleLike(int $postId, UserInterface $currentUser): bool
    {
        $post = $this->postRepository->find($postId);

        // Make sure about like - does it is or not?
        $isLikedByCurrentUser = $post->getLikes()->filter(function ($like) use ($currentUser) {
            return $like->getUser() === $currentUser;
        })->count() > 0;

        if (!$isLikedByCurrentUser) {
            // make a new like if it is not being
            $like = new PostUserLikes();
            $like->setUser($currentUser);
            $like->setPost($post);

            $post->addLike($like);

            // Save changes
            $this->postUserLikesRepository->save($like);
            $heartImageStatus = true;
        } else {
            // Delete like if it is being
            $existingLike = $post->getLikes()->filter(function ($like) use ($currentUser) {
                return $like->getUser() === $currentUser;
            })->first();

            if ($existingLike) {
                $post->removeLike($existingLike);

                $this->postUserLikesRepository->remove($existingLike);

                $heartImageStatus = false;
            }
        }
        return $heartImageStatus;
    }
}
