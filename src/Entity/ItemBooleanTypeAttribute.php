<?php

namespace App\Entity;

use App\Repository\ItemBooleanTypeAttributeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemBooleanTypeAttributeRepository::class)]
class ItemBooleanTypeAttribute
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $value = null;

    #[ORM\ManyToOne(inversedBy: 'ItemAttributeBooleanFields')]
    private ?CustomItemAttribute $customItemAttribute = null;

    #[ORM\ManyToOne(inversedBy: 'itemAttributeBolleanFields')]
    private ?CollectionItem $collectionItem = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isValue(): ?bool
    {
        return $this->value;
    }

    public function setValue(bool $value): static
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
