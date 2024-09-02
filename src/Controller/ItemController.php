<?php

namespace App\Controller;

use App\Entity\CollectionItem;
use App\Entity\ItemCollection;
use App\Entity\ItemIntegerTypeAttribute;
use App\Form\ItemCreateType;
use App\Form\TestType;
use App\Form\ItemCustomAttributeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ItemController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager)
    {

    }

    #[Route('collection/{id}/item', name: 'app_item')]
    public function index(): Response
    {
        return $this->render('item/index.html.twig', [
            'controller_name' => 'ItemController',
        ]);
    }


    #[Route('/collection/{id}/item/create', name: 'app_item_create', methods: [Request::METHOD_GET, Request::METHOD_POST])]
    public function create(Request $request, string $id, EntityManagerInterface $entityManager): Response
    {
        $collection = $entityManager->getRepository(ItemCollection::class)->findOneBy(['id' => $id]);
        $idCollection = $collection->getId();
        $attributes = $collection->getCustomItemAttribute()->getValues();
        $attributesName = [];
        
        foreach ($attributes as $attribute) {
            $attributesName[] = [
                $attribute -> getName(),
            ];
        }

        $item = new CollectionItem();
        $testitem = new ItemIntegerTypeAttribute();

        $form = $this->createForm(ItemCreateType::class, $item);
        $form->handleRequest($request);

        $testform = $this->createForm(TestType::class, null, [
            'data' => $testitem,
        ]);
        $testform->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this -> entityManager -> persist($item);
            $this -> entityManager -> flush();

            $this -> addFlash('success', 'Item created!');
        }

        return $this->render('item/form.html.twig', [
            'form' => $form,
            'testform' => $testform,
            'testitem' => $testitem,
            'item' => $item,
            'attributes' => $attributesName,
        ]);
    }
}
