<?php

namespace App\Entity;

use App\Enum\CustomAttributeType;
use App\Repository\CustomItemAttributeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CustomItemAttributeRepository::class)]
class CustomItemAttribute
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $name = null;

    #[ORM\Column(length: 20, enumType: CustomAttributeType::class)]
    #[Assert\Type(type: CustomAttributeType::class)]
    #[Assert\NotNull]
    private ?CustomAttributeType $type = null;

    #[ORM\ManyToOne(inversedBy: 'customItemAttribute')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ItemCollection $itemCollection = null;

    /**
     * @var Collection<int, ItemBooleanTypeAttribute>
     */
    #[ORM\OneToMany(targetEntity: ItemBooleanTypeAttribute::class, mappedBy: 'customItemAttribute')]
    private Collection $ItemAttributeBooleanFields;

    /**
     * @var Collection<int, ItemDateTypeAttribute>
     */
    #[ORM\OneToMany(targetEntity: ItemDateTypeAttribute::class, mappedBy: 'customItemAttribute')]
    private Collection $ItemAttributeDateFields;

    /**
     * @var Collection<int, ItemIntegerTypeAttribute>
     */
    #[ORM\OneToMany(targetEntity: ItemIntegerTypeAttribute::class, mappedBy: 'customItemAttribute')]
    private Collection $ItemAttributeIntegerFields;

    /**
     * @var Collection<int, ItemStringTypeAttribute>
     */
    #[ORM\OneToMany(targetEntity: ItemStringTypeAttribute::class, mappedBy: 'customItemAttribute')]
    private Collection $ItemAttributeStringFields;

    /**
     * @var Collection<int, ItemTextTypeAttribute>
     */
    #[ORM\OneToMany(targetEntity: ItemTextTypeAttribute::class, mappedBy: 'customItemAttribute')]
    private Collection $ItemAttributeTextFields;

    public function __construct()
    {
        $this->ItemAttributeBooleanFields = new ArrayCollection();
        $this->ItemAttributeDateFields = new ArrayCollection();
        $this->ItemAttributeIntegerFields = new ArrayCollection();
        $this->ItemAttributeStringFields = new ArrayCollection();
        $this->ItemAttributeTextFields = new ArrayCollection();
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

    public function getItemCollection(): ?ItemCollection
    {
        return $this->itemCollection;
    }

    public function setItemCollection(?ItemCollection $itemCollection): static
    {
        $this->itemCollection = $itemCollection;

        return $this;
    }

    public function getType(): ?CustomAttributeType
    {
        return $this->type;
    }

    public function setType(CustomAttributeType $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, ItemBooleanTypeAttribute>
     */
    public function getItemAttributeBooleanFields(): Collection
    {
        return $this->ItemAttributeBooleanFields;
    }

    public function addItemAttributeBooleanFieald(ItemBooleanTypeAttribute $itemAttributeBooleanFieald): static
    {
        if (!$this->ItemAttributeBooleanFields->contains($itemAttributeBooleanFieald)) {
            $this->ItemAttributeBooleanFields->add($itemAttributeBooleanFieald);
            $itemAttributeBooleanFieald->setCustomItemAttribute($this);
        }

        return $this;
    }

    public function removeItemAttributeBooleanFieald(ItemBooleanTypeAttribute $itemAttributeBooleanFieald): static
    {
        if ($this->ItemAttributeBooleanFields->removeElement($itemAttributeBooleanFieald)) {
            // set the owning side to null (unless already changed)
            if ($itemAttributeBooleanFieald->getCustomItemAttribute() === $this) {
                $itemAttributeBooleanFieald->setCustomItemAttribute(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ItemDateTypeAttribute>
     */
    public function getItemAttributeDateFields(): Collection
    {
        return $this->ItemAttributeDateFields;
    }

    public function addItemAttributeDateFieald(ItemDateTypeAttribute $itemAttributeDateFieald): static
    {
        if (!$this->ItemAttributeDateFields->contains($itemAttributeDateFieald)) {
            $this->ItemAttributeDateFields->add($itemAttributeDateFieald);
            $itemAttributeDateFieald->setCustomItemAttribute($this);
        }

        return $this;
    }

    public function removeItemAttributeDateFieald(ItemDateTypeAttribute $itemAttributeDateFieald): static
    {
        if ($this->ItemAttributeDateFields->removeElement($itemAttributeDateFieald)) {
            // set the owning side to null (unless already changed)
            if ($itemAttributeDateFieald->getCustomItemAttribute() === $this) {
                $itemAttributeDateFieald->setCustomItemAttribute(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ItemIntegerTypeAttribute>
     */
    public function getItemAttributeIntegerFields(): Collection
    {
        return $this->ItemAttributeIntegerFields;
    }

    public function addItemAttributeIntegerField(ItemIntegerTypeAttribute $itemAttributeIntegerField): static
    {
        if (!$this->ItemAttributeIntegerFields->contains($itemAttributeIntegerField)) {
            $this->ItemAttributeIntegerFields->add($itemAttributeIntegerField);
            $itemAttributeIntegerField->setCustomItemAttribute($this);
        }

        return $this;
    }

    public function removeItemAttributeIntegerField(ItemIntegerTypeAttribute $itemAttributeIntegerField): static
    {
        if ($this->ItemAttributeIntegerFields->removeElement($itemAttributeIntegerField)) {
            // set the owning side to null (unless already changed)
            if ($itemAttributeIntegerField->getCustomItemAttribute() === $this) {
                $itemAttributeIntegerField->setCustomItemAttribute(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ItemStringTypeAttribute>
     */
    public function getItemAttributeStringFields(): Collection
    {
        return $this->ItemAttributeStringFields;
    }

    public function addItemAttributeStringField(ItemStringTypeAttribute $itemAttributeStringField): static
    {
        if (!$this->ItemAttributeStringFields->contains($itemAttributeStringField)) {
            $this->ItemAttributeStringFields->add($itemAttributeStringField);
            $itemAttributeStringField->setCustomItemAttribute($this);
        }

        return $this;
    }

    public function removeItemAttributeStringField(ItemStringTypeAttribute $itemAttributeStringField): static
    {
        if ($this->ItemAttributeStringFields->removeElement($itemAttributeStringField)) {
            // set the owning side to null (unless already changed)
            if ($itemAttributeStringField->getCustomItemAttribute() === $this) {
                $itemAttributeStringField->setCustomItemAttribute(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ItemTextTypeAttribute>
     */
    public function getItemAttributeTextFields(): Collection
    {
        return $this->ItemAttributeTextFields;
    }

    public function addItemAttributeTextField(ItemTextTypeAttribute $itemAttributeTextField): static
    {
        if (!$this->ItemAttributeTextFields->contains($itemAttributeTextField)) {
            $this->ItemAttributeTextFields->add($itemAttributeTextField);
            $itemAttributeTextField->setCustomItemAttribute($this);
        }

        return $this;
    }

    public function removeItemAttributeTextField(ItemTextTypeAttribute $itemAttributeTextField): static
    {
        if ($this->ItemAttributeTextFields->removeElement($itemAttributeTextField)) {
            // set the owning side to null (unless already changed)
            if ($itemAttributeTextField->getCustomItemAttribute() === $this) {
                $itemAttributeTextField->setCustomItemAttribute(null);
            }
        }

        return $this;
    }
}
