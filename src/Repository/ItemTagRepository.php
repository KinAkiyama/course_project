<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Item\ItemTag;
use App\Entity\Item\TagsItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class ItemTagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemTag::class);
    }
}