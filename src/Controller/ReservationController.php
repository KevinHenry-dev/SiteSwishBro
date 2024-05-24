<?php

namespace App\Controller;


use App\Entity\Reservations;
use App\Repository\CalendarRepository;
use App\Repository\ReservationsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ReservationController extends AbstractController
{
    #[Route('/participation', name: 'app_participation', methods: ['POST'])]
    public function participation(Request $request, EntityManagerInterface $entityManager, CalendarRepository $calendarRepository, ReservationsRepository $reservationsRepository ): Response
    {

        $data = json_decode($request->getContent(), true);

        $calendarId = $data['calendarId'];
        $action = $data['action'];

        $calendar = $calendarRepository->find($calendarId);
        $user = $this->getUser();
        
        if(!$calendar) return new JsonResponse(['success' => false, 'error' => "Evenement not found !"]);

        $reservation = $reservationsRepository->findOneBy(['id_calendar' => $calendar, 'id_user' => $user]);
        
        if($action == 'ajouter')
        {
            if($reservation)  return new JsonResponse(['success' => false, 'error' => "Vous avez déjà réservé !"]);

            $reservation = new Reservations();
            $reservation->setIdCalendar($calendar);
            $reservation->setIdUser($user);
            $entityManager->persist($reservation);
        
        } 
        elseif ($action == 'retirer')
        {
            if(!$reservation)  return new JsonResponse(['success' => false, 'error' => "aucune réservation "]);

            $entityManager->remove($reservation);
        } 
        else 
        {
            return new JsonResponse(['success' => false, 'error' => "action n'est pas reconnue"]);
        }

        $entityManager->flush();

        // Compter le nombre de participants
        $numberOfParticipants = $reservationsRepository->countByCalendar($calendar);

        return new JsonResponse(['success' => true, 'participants' => $numberOfParticipants]);

        
    }
}
