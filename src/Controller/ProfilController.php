<?php

namespace App\Controller;

use App\Entity\User;


use App\Form\EditProfileUserFormType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


#[Route('/profil')]
class ProfilController extends AbstractController
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    #[Route('/', name: 'app_profil_index', methods: ['GET'])]
    public function index(): Response
    {
        // Récupérer l'utilisateur connecté à partir du TokenStorage
        $user = $this->tokenStorage->getToken()->getUser();

        // Vérifier si l'utilisateur est connecté
        if (!$user instanceof User) {
            // Rediriger vers la page de connexion ou afficher un message d'erreur
            // return $this->redirectToRoute('app_login');
            throw $this->createNotFoundException('Utilisateur non connecté.');
        }

        // Afficher uniquement le profil de l'utilisateur connecté
        return $this->render('profil/index.html.twig', [
            'user' => $user,
        ]);
    }

    // Les autres méthodes du contrôleur restent inchangées




/* 

    #[Route('/{id}', name: 'app_profil_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('profil/show.html.twig', [
            'user' => $user,
        ]);
    } */

    #[Route('/{id}/edit', name: 'app_profil_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
{
    $user = $this->getUser();
    $form = $this->createForm(EditProfileUserFormType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $newPassword = $form->get('plainPassword')->getData();
        if ($newPassword !== null) {
            $hashedPassword = $passwordHasher->hashPassword($user, $newPassword);
            $this->upgradePassword($user, $hashedPassword, $entityManager);
        }

        $entityManager->flush();
        
        
        return $this->redirectToRoute('app_profil_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->render('profil/edit.html.twig', [
        'user' => $user,
        'form' => $form->createView(),
    ]);
}

private function upgradePassword(User $user, string $hashedPassword, EntityManagerInterface $entityManager): void
{
    $user->setPassword($hashedPassword);
    $entityManager->persist($user);
}



    #[Route('/{id}', name: 'app_profil_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_register', [], Response::HTTP_SEE_OTHER);
    }
}
