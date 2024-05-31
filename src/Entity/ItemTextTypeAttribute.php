<?php

namespace App\Entity;

use App\Repository\ItemTextTypeAttributeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemTextTypeAttributeRepository::class)]
class ItemTextTypeAttribute
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $value = null;

    #[ORM\ManyToOne(inversedBy: 'ItemAttributeTextFields')]
    private ?CustomItemAttribute $customItemAttribute = null;

    #[ORM\ManyToOne(inversedBy: 'itemAttributeTextFields')]
    private ?CollectionItem $collectionItem = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getCustomItemAttribute(): ?CustomItemAttribute
    {
        return $this->customItemAttribute;
    }

    public function setCustomItemAttribute(?CustomItemAttribute $customItemAttribute): static
    {
        $this->customItemAttribute = $customItemAttribute;

        return $this;
    }

    public function getCollectionItem(): ?CollectionItem
    {
        return $this->collectionItem;
    }

    public function setCollectionItem(?CollectionItem $collectionItem): static
    {
        $this->collectionItem = $collectionItem;

        return $this;
    }
}
