<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Repository\UserRepository;

class UserController extends AbstractController
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ) {}

    #[Route('/', name: 'app_user', methods: ['GET'])    ]
    public function index(EntityManagerInterface $entityManager): Response
    {
        return $this->render('user/index.html.twig', [
           'users' => $this->userRepository->findAll(),
        ]);
    }
}
