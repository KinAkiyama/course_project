<?php

namespace App\Entity;

use App\Repository\CollectionItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CollectionItemRepository::class)]
class CollectionItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updated = null;

    /**
     * @var Collection<int, ItemBooleanTypeAttribute>
     */
    #[ORM\OneToMany(targetEntity: ItemBooleanTypeAttribute::class, mappedBy: 'collectionItem')]
    private Collection $itemAttributeBolleanFields;

    /**
     * @var Collection<int, ItemDateTypeAttribute>
     */
    #[ORM\OneToMany(targetEntity: ItemDateTypeAttribute::class, mappedBy: 'collectionItem')]
    private Collection $itemAttributeDateFields;

    /**
     * @var Collection<int, ItemIntegerTypeAttribute>
     */
    #[ORM\OneToMany(targetEntity: ItemIntegerTypeAttribute::class, mappedBy: 'collectionItem')]
    private Collection $itemAttributeIntegerFields;

    /**
     * @var Collection<int, ItemStringTypeAttribute>
     */
    #[ORM\OneToMany(targetEntity: ItemStringTypeAttribute::class, mappedBy: 'collectionItem')]
    private Collection $itemAttributeStringFields;

    /**
     * @var Collection<int, ItemTextTypeAttribute>
     */
    #[ORM\OneToMany(targetEntity: ItemTextTypeAttribute::class, mappedBy: 'collectionItem')]
    private Collection $itemAttributeTextFields;

    #[ORM\ManyToOne(inversedBy: 'collectionItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ItemCollection $itemCollection = null;

    public function __construct()
    {
        $this->itemAttributeBolleanFields = new ArrayCollection();
        $this->itemAttributeDateFields = new ArrayCollection();
        $this->itemAttributeIntegerFields = new ArrayCollection();
        $this->itemAttributeStringFields = new ArrayCollection();
        $this->itemAttributeTextFields = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): static
    {
        $this->created = $created;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): static
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * @return Collection<int, ItemBooleanTypeAttribute>
     */
    public function getItemAttributeBolleanFields(): Collection
    {
        return $this->itemAttributeBolleanFields;
    }

    public function addItemAttributeBolleanField(ItemBooleanTypeAttribute $itemAttributeBolleanField): static
    {
        if (!$this->itemAttributeBolleanFields->contains($itemAttributeBolleanField)) {
            $this->itemAttributeBolleanFields->add($itemAttributeBolleanField);
            $itemAttributeBolleanField->setCollectionItem($this);
        }

        return $this;
    }

    public function removeItemAttributeBolleanField(ItemBooleanTypeAttribute $itemAttributeBolleanField): static
    {
        if ($this->itemAttributeBolleanFields->removeElement($itemAttributeBolleanField)) {
            // set the owning side to null (unless already changed)
            if ($itemAttributeBolleanField->getCollectionItem() === $this) {
                $itemAttributeBolleanField->setCollectionItem(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ItemDateTypeAttribute>
     */
    public function getItemAttributeDateFields(): Collection
    {
        return $this->itemAttributeDateFields;
    }

    public function addItemAttributeDateField(ItemDateTypeAttribute $itemAttributeDateField): static
    {
        if (!$this->itemAttributeDateFields->contains($itemAttributeDateField)) {
            $this->itemAttributeDateFields->add($itemAttributeDateField);
            $itemAttributeDateField->setCollectionItem($this);
        }

        return $this;
    }

    public function removeItemAttributeDateField(ItemDateTypeAttribute $itemAttributeDateField): static
    {
        if ($this->itemAttributeDateFields->removeElement($itemAttributeDateField)) {
            // set the owning side to null (unless already changed)
            if ($itemAttributeDateField->getCollectionItem() === $this) {
                $itemAttributeDateField->setCollectionItem(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ItemIntegerTypeAttribute>
     */
    public function getItemAttributeIntegerFields(): Collection
    {
        return $this->itemAttributeIntegerFields;
    }

    public function addItemAttributeIntegerField(ItemIntegerTypeAttribute $itemAttributeIntegerField): static
    {
        if (!$this->itemAttributeIntegerFields->contains($itemAttributeIntegerField)) {
            $this->itemAttributeIntegerFields->add($itemAttributeIntegerField);
            $itemAttributeIntegerField->setCollectionItem($this);
        }

        return $this;
    }

    public function removeItemAttributeIntegerField(ItemIntegerTypeAttribute $itemAttributeIntegerField): static
    {
        if ($this->itemAttributeIntegerFields->removeElement($itemAttributeIntegerField)) {
            // set the owning side to null (unless already changed)
            if ($itemAttributeIntegerField->getCollectionItem() === $this) {
                $itemAttributeIntegerField->setCollectionItem(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ItemStringTypeAttribute>
     */
    public function getItemAttributeStringFields(): Collection
    {
        return $this->itemAttributeStringFields;
    }

    public function addItemAttributeStringField(ItemStringTypeAttribute $itemAttributeStringField): static
    {
        if (!$this->itemAttributeStringFields->contains($itemAttributeStringField)) {
            $this->itemAttributeStringFields->add($itemAttributeStringField);
            $itemAttributeStringField->setCollectionItem($this);
        }

        return $this;
    }

    public function removeItemAttributeStringField(ItemStringTypeAttribute $itemAttributeStringField): static
    {
        if ($this->itemAttributeStringFields->removeElement($itemAttributeStringField)) {
            // set the owning side to null (unless already changed)
            if ($itemAttributeStringField->getCollectionItem() === $this) {
                $itemAttributeStringField->setCollectionItem(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ItemTextTypeAttribute>
     */
    public function getItemAttributeTextFields(): Collection
    {
        return $this->itemAttributeTextFields;
    }

    public function addItemAttributeTextField(ItemTextTypeAttribute $itemAttributeTextField): static
    {
        if (!$this->itemAttributeTextFields->contains($itemAttributeTextField)) {
            $this->itemAttributeTextFields->add($itemAttributeTextField);
            $itemAttributeTextField->setCollectionItem($this);
        }

        return $this;
    }

    public function removeItemAttributeTextField(ItemTextTypeAttribute $itemAttributeTextField): static
    {
        if ($this->itemAttributeTextFields->removeElement($itemAttributeTextField)) {
            // set the owning side to null (unless already changed)
            if ($itemAttributeTextField->getCollectionItem() === $this) {
                $itemAttributeTextField->setCollectionItem(null);
            }
        }

        return $this;
    }

    public function getItemCollection(): ?ItemCollection
    {
        return $this->itemCollection;
    }

    public function setItemCollection(?ItemCollection $itemCollection): static
    {
        $this->itemCollection = $itemCollection;

        return $this;
    }
}
