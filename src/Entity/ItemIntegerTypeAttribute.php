<?php

namespace App\Entity;

use App\Repository\ItemIntegerTypeAttributeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemIntegerTypeAttributeRepository::class)]
class ItemIntegerTypeAttribute
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $value = null;

    #[ORM\ManyToOne(inversedBy: 'ItemAttributeIntegerFields')]
    private ?CustomItemAttribute $customItemAttribute = null;

    #[ORM\ManyToOne(inversedBy: 'itemAttributeIntegerFields')]
    private ?CollectionItem $collectionItem = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): static
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
