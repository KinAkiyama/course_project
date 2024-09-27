<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Item;
use App\Entity\ItemCollection;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainPageController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function view(EntityManagerInterface $entityManager): Response
    {
        $receivedCollections = $entityManager->getRepository(ItemCollection::class)->findAll();
        $collections = [];
        foreach ($receivedCollections as $collection) {
            $collections[] = [
                'id' => $collection->getId(),
                'name' => $collection->getName(),
                'description' => $collection->getDescription(),
                'category' => $collection->getCategory()->getName(),
                'count_item' => $collection->getItem()->count(),
            ];
        }

        usort($collections, function ($a, $b) {
            return ($b['count_item']-$a['count_item']);
        });

        $biggestCollection = array_slice($collections, 0, 5);

        $receivedItems = $entityManager->getRepository(Item::class)->findBy([],['id'=>'DESC']);
        $itemByTag = [];

        foreach($receivedItems as $item) {
            foreach($item->getTags() as $tag) {
                $itemByTag[] = $tag->getName();
            }
        }

        $itemCount = array_slice($receivedItems, 0, 6);

        $items = [];
        foreach($itemCount as $item) {
            $items[] = [
                'id' => $item->getId(),
                'name' => $item->getName(),
                'collection_name' => $item->getItemCollection()->getName(),
                $user = $entityManager->getRepository(User::class)->findOneBy(['id' => $item->getUserId()]),
                'username' => $user->getUsername(),
            ];
        }

        $tags = array_count_values($itemByTag);
        return $this->render('main.html.twig', [
            'collections' => $biggestCollection,
            'items' => $items,
            'tags' => $tags,
        ]);
    }
}