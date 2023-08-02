<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Expr\BinaryOp\BooleanOr;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    /**
     * @var int
     */
    private ?int $id;

    #[ORM\Column(length: 180, unique: true)]
    /**
     * @var string
     */
    private ?string $email;

    #[ORM\Column]
    /**
     * @var array
     */
    private array $roles = [];

    private $userVerifStatus;

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    /**
     * @var string
     */
    private ?string $password;

    #[ORM\Column(length: 20)]
    /**
     * @var string
     */
    private ?string $NickName;

    #[ORM\Column(length: 255, nullable: true)]
    /**
     * @var string
     */
    private ?string $description;

    #[ORM\Column(length: 255, nullable: true)]
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
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * 
     * @return static
     */
    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param array $roles
     * 
     * @return static
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * 
     * @return static
     */
    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @param Bool $isVerified
     * 
     * @return User
     */
    public function setIsVerified(Bool $isVerified): User
    {
        $userVerifStatus = $isVerified;
        $this->userVerifStatus = $isVerified;

        return $this;
        
    }

    /**
     * @return bool
     */
    public function getIsVerified(): bool
    {
        return $this->userVerifStatus;
    }

    /**
     * @return string|null
     */
    public function getNickName(): ?string
    {
        return $this->NickName;
    }

    /**
     * @param string $NickName
     * 
     * @return static
     */
    public function setNickName(string $NickName): static
    {
        $this->NickName = $NickName;

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
     * @param string|null $imagePath
     * 
     * @return static
     */
    public function setImagePath(?string $imagePath): static
    {
        $this->imagePath = $imagePath;

        return $this;
    }



}
