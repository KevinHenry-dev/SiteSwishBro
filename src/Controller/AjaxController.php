<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class AjaxController extends AbstractController
{
    #[Route('/user/ban', name: 'app_ajax_user_ban', methods:["POST"])]

    public function userBan(Request $request, UserRepository $userRepository, EntityManagerInterface $em)
    {
        $userId = $request->request->get('id');
        $user = $userRepository->find($userId);
        $message = '';
        if ($user->isBan()) {//si le bool est à =1
            $user->setBan(false);
        }else{//si le bool est = à 0
            $user->setBan(true);
            $message = 'l\'utilisateur n\'est plus banni';
        }
        $em->flush();

        return new JsonResponse($message);
    }
}