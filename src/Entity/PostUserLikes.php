<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\PostUserLikesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostUserLikesRepository::class)]
class PostUserLikes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    /**
     * @var int
     */
    private int $id;

    #[ORM\ManyToOne(inversedBy: 'likes')]
    /**
     * @var Post
     */
    private ?Post $post;

    #[ORM\ManyToOne(inversedBy: 'likes')]
    /**
     * @var User
     */
    private ?User $user;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Post
     */
    public function getPost(): ?Post
    {
        return $this->post;
    }

    /**
     * @param Post $post
     * 
     * @return static
     */
    public function setPost(?Post $post): static
    {
        $this->post = $post;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * 
     * @return static
     */
    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
