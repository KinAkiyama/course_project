<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    #[Route('/signup', name: 'signup')]
    public function registration(
        EntityManagerInterface $entityManager,
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        Security $security,
    ): Response {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $username = $form->get('username')->getData();
            $password = $form->get('password')->getData();
    
            $findUsername = $entityManager
                ->getRepository(User::class)
                ->findOneBy(['username' => $username]);
    
            if ($findUsername !== null) {
                $form->get('username')->addError(new FormError('Username already exists'));
            } else {
                $user = new User();
                $user->setUsername($username);
                $user->setPassword($passwordHasher->hashPassword($user, $password));
    
                $entityManager->persist($user);
                $entityManager->flush();
    
                $security->login($user);
    
                return $this->redirectToRoute('main');
            }
        }
    
        return $this->render('signup.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/signin', name: 'signin')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(LoginType::class, null, [
            'csrf_field_name' => 'token',
            'csrf_token_id' => 'signin',
            'lastUsername' => $lastUsername,
        ]);

        if ($form->isSubmitted() && $form->isValid()){
            return $this->redirectToRoute('main');
        }

        return $this->render('signin.html.twig', [
            'form' => $form->createView(),
            'error' => $error,
        ]);
    }
}