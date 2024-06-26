<?php

namespace App\Entity;

use App\Repository\ItemCollectionRepository;
use App\Validator\CollectionCustomAttribute;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ItemCollectionRepository::class)]
class ItemCollection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $name = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank]
    private ?CollectionCategory $category = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, CustomItemAttribute>
     */

    #[ORM\OneToMany(targetEntity: CustomItemAttribute::class, mappedBy: 'itemCollection', orphanRemoval: true, cascade: ['persist'] )]
    #[Assert\Valid()]
    #[CollectionCustomAttribute()]
    private Collection $customItemAttribute;

    #[ORM\ManyToOne(inversedBy: 'userCollections')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $author = null;

    /**
     * @var Collection<int, CollectionItem>
     */
    #[ORM\OneToMany(targetEntity: CollectionItem::class, mappedBy: 'itemCollection', orphanRemoval: true)]
    private Collection $collectionItems;

    public function __construct()
    {
        $this->customItemAttribute = new ArrayCollection();
        $this->collectionItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCategory(): ?CollectionCategory
    {
        return $this->category;
    }

    public function setCategory(?CollectionCategory $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, CustomItemAttribute>
     */
    public function getCustomItemAttribute(): Collection
    {
        return $this->customItemAttribute;
    }

    public function addCustomItemAttribute(CustomItemAttribute $customItemAttribute): static
    {
        if (!$this->customItemAttribute->contains($customItemAttribute)) {
            $this->customItemAttribute->add($customItemAttribute);
            $customItemAttribute->setItemCollection($this);
        }

        return $this;
    }

    public function removeCustomItemAttribute(CustomItemAttribute $customItemAttribute): static
    {
        if ($this->customItemAttribute->removeElement($customItemAttribute)) {
            // set the owning side to null (unless already changed)
            if ($customItemAttribute->getItemCollection() === $this) {
                $customItemAttribute->setItemCollection(null);
            }
        }

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): static
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection<int, CollectionItem>
     */
    public function getCollectionItems(): Collection
    {
        return $this->collectionItems;
    }

    public function addCollectionItem(CollectionItem $collectionItem): static
    {
        if (!$this->collectionItems->contains($collectionItem)) {
            $this->collectionItems->add($collectionItem);
            $collectionItem->setItemCollection($this);
        }

        return $this;
    }

    public function removeCollectionItem(CollectionItem $collectionItem): static
    {
        if ($this->collectionItems->removeElement($collectionItem)) {
            // set the owning side to null (unless already changed)
            if ($collectionItem->getItemCollection() === $this) {
                $collectionItem->setItemCollection(null);
            }
        }

        return $this;
    }

}
