<?php

namespace App\Controller;

use App\Entity\CollectionItem;
use App\Entity\ItemCollection;
use App\Entity\ItemIntegerTypeAttribute;
use App\Entity\ItemStringTypeAttribute;
use App\Entity\CustomItemAttribute;
use App\Entity\ItemBooleanTypeAttribute;
use App\Entity\ItemDateTypeAttribute;
use App\Entity\ItemTextTypeAttribute;
use App\Form\ItemCreateType;
use App\Form\TestType;
use App\Enum\CustomAttributeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints\Length;

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
        $arrOfAttr = $entityManager->getRepository(CustomItemAttribute::class)->findBy(['itemCollection' => $id]);
        $attrTypesArray = [];
        $arrOfTypes = [];

        foreach ($arrOfAttr as $attribute) {
            $typeEnum = $attribute->getType();
            $typeName = CustomAttributeType::name($typeEnum); 
            $attrTypesArray[] = $typeName; 
        }

        $attributes = $collection->getCustomItemAttribute()->getValues();
            
        foreach ($attributes as $attribute) {
            $attributesName[] = [
                $attribute -> getName(),
            ];
        }

        $item = new CollectionItem();
        $types = [
            'Integer' => new ItemIntegerTypeAttribute(),
            'String' => new ItemStringTypeAttribute(),
            'Boolean' => new ItemBooleanTypeAttribute(),
            'Date' => new ItemDateTypeAttribute(),
            'Text' => new ItemTextTypeAttribute(),
        ];

        foreach ($attrTypesArray as $key) {
            if (array_key_exists($key, $types)) {
                $arrOfTypes[] = $types[$key];
            }
        }

        $form = $this->createForm(ItemCreateType::class, $item);
        $form->handleRequest($request);

        $forms = [];

        foreach ($arrOfTypes as $type => $attribute) {
            $testform = $this->createForm(TestType::class, $attribute, [
                'attribute_type' => $type,
            ]);
            $testform->handleRequest($request);
            
            if ($testform->isSubmitted() && $testform->isValid()) {
                $this->entityManager->flush();
            }
        
            $forms[] = $testform->createView();
        }

        if ($form->isSubmitted() && $form->isValid())
        {
            $this -> entityManager -> persist($item);
            $this -> entityManager -> flush();

            $this -> addFlash('success', 'Item created!');
        }

        return $this->render('item/form.html.twig', [
            'form' => $form,
            'forms' => $forms,
            'item' => $item,
            'atr' => $arrOfTypes,
            'attributes' => $attributesName,
        ]);
    }
}
