<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\ItemCollection;
use App\Entity\User;
use App\Repository\UserRepository;

class UserController extends AbstractController
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private EntityManagerInterface $em,
    ) {}

    #[Route(path: '/' ,name: 'app_user', methods: ['GET'])    ]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $collections = $this->em->getRepository(ItemCollection::class)->findAll();

        //sort for collections

        $topFiveLargestCollections = array_slice($collections, 0, 5);

        return $this->render('user/index.html.twig', [
           'users' => $this->userRepository->findAll(),
           'collections' => $topFiveLargestCollections,
        ]);
    }
}
