<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`users`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank('Please enter your email')]
    private ?string $email = null;
    
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank('Please enter your username')]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Assert\NotBlank('Please enter the password')]
    private ?string $password = null;

    /**
     * @var Collection<int, ItemCollection>
     */
    #[ORM\OneToMany(targetEntity: ItemCollection::class, mappedBy: 'author', orphanRemoval: true)]
    private Collection $userCollections;

    public function __construct()
    {
        $this->userCollections = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

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
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_VIEWER
        $roles[] = 'ROLE_VIEWER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, ItemCollection>
     */
    public function getUserCollections(): Collection
    {
        return $this->userCollections;
    }

    public function addUserCollection(ItemCollection $userCollection): static
    {
        if (!$this->userCollections->contains($userCollection)) {
            $this->userCollections->add($userCollection);
            $userCollection->setAuthor($this);
        }

        return $this;
    }

    public function removeUserCollection(ItemCollection $userCollection): static
    {
        if ($this->userCollections->removeElement($userCollection)) {
            // set the owning side to null (unless already changed)
            if ($userCollection->getAuthor() === $this) {
                $userCollection->setAuthor(null);
            }
        }

        return $this;
    }
}
