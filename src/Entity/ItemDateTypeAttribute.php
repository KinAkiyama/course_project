<?php

namespace App\Entity;

use App\Repository\ItemDateTypeAttributeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemDateTypeAttributeRepository::class)]
class ItemDateTypeAttribute
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $value = null;

    #[ORM\ManyToOne(inversedBy: 'ItemAttributeDateFields')]
    private ?CustomItemAttribute $customItemAttribute = null;

    #[ORM\ManyToOne(inversedBy: 'itemAttributeDateFields')]
    private ?CollectionItem $collectionItem = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?\DateTimeInterface
    {
        return $this->value;
    }

    public function setValue(\DateTimeInterface $value): static
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
