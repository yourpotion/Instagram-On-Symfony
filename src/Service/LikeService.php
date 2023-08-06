<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\PostsRepository;
use Doctrine\ORM\EntityManager;

class LikeService {
    private $em;
    private $postsRepository;
    
    public function __construct(PostsRepository $postsRepository, EntityManager $em)
    {
        $this->postsRepository = $postsRepository;
        $this->em = $em;
    }

    public function addLike($post_id) {

        $repository = $this->em->getRepository(Post::class);
        
        $post = $repository->findOneBy($post_id);
        $post->addLike();
        $this->postsRepository->save($post);
    }
}