<?php

namespace App\Controller;

use App\Entity\ItemCollection;
use App\Form\CollectionCreateType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CollectionController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager, private Security $security)
    {

    }

    #[Route('/collection', name: 'app_collection')]
    public function index(): Response
    {
        return $this->render('collection/index.html.twig', [
            'controller_name' => 'CollectionController',
        ]);
    }

    #[Route('/collection/create', name: 'app_collection_create', methods: [Request::METHOD_GET, Request::METHOD_POST])]
    public function create(Request $request): Response
    {
        $collection = new ItemCollection();
        $form = $this->createForm(CollectionCreateType::class, $collection);
        $form->handleRequest($request);

        $user = $this->security->getUser(); 

        $collection -> setAuthor($user);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this -> entityManager -> persist($collection);
            $this -> entityManager -> flush();

            $this -> addFlash('success', 'Collection created!');
        }

        return $this->render('collection/form.html.twig', [
            'collectionForm' => $form,
        ]);
    }

    #[Route('/collection/{id}/update', name: 'app_collection_update', methods: [Request::METHOD_GET, Request::METHOD_POST])]
    public function update(Request $request, ItemCollection $collection): Response
    {
        $form = $this->createForm(CollectionCreateType::class, $collection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this -> entityManager -> flush();

            $this -> addFlash('success', 'Collection updated!');
        }

        return $this->render('collection/form.html.twig', [
            'action' => 'Update',
            'collectionForm' => $form,
            'collection' => $collection,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_collection_delete', methods: [Request::METHOD_GET])]
    public function delete(int $id): Response
    {
        $collection = $this -> entityManager -> getRepository(ItemCollection::class) -> find($id);
        $this -> entityManager -> remove($collection);
        $this -> entityManager -> flush();

        return $this -> redirectToRoute('app_user');
    }

    #[Route('/collection/{id}', name: 'app_collection_show')]
    public function show(int $id): Response
    {
        $collection = $this -> entityManager -> getRepository(ItemCollection::class) -> find($id);

        return $this -> render('collection/collectionPage.html.twig', [
            'collection' => $collection
        ]);
    }
}
