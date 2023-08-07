<?php

declare(strict_types=1);


namespace App\Entity;

use App\Repository\FollowingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FollowingRepository::class)]
class Following
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    /**
     * @var int
     */
    private int $id;



    #[ORM\ManyToOne(inversedBy: 'follower')]
    /**
     * @var User
     */
    private ?User $follower;

    #[ORM\ManyToOne(inversedBy: 'followings')]
    /**
     * @var User
     */
    private ?User $user;

    public function __construct()
    {

    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getFollower(): ?User
    {
        return $this->follower;
    }

    /**
     * @param User $user
     * 
     * @return static
     */
    public function setFollower(?User $user): static
    {
        $this->follower = $user;

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
