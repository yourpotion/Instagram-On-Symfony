<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    /**
     * @var int
     */
    private ?int $id;

    #[ORM\Column(length: 255)]
    /**
     * @var string
     */
    private ?string $title;

    #[ORM\Column]
    /**
     * @var int
     */
    private ?int $releaseDate;

    #[ORM\Column(length: 255, nullable: true)]
    /**
     * @var string
     */
    private ?string $description;

    #[ORM\Column(length: 255)]
    /**
     * @var string
     */
    private ?string $imagePath;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * 
     * @return static
     */
    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return int
     */
    public function getReleaseDate(): ?int
    {
        return $this->releaseDate;
    }

    /**
     * @param int $releaseDate
     * 
     * @return static
     */
    public function setReleaseDate(int $releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * 
     * @return static
     */
    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    /**
     * @param string $imagePath
     * 
     * @return static
     */
    public function setImagePath(string $imagePath): static
    {
        $this->imagePath = $imagePath;

        return $this;
    }
}
