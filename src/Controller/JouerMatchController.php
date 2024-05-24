<?php

namespace App\Controller;

use App\Entity\Calendar;
use App\Repository\CalendarRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class JouerMatchController extends AbstractController
{
    #[Route('/jouer', name: 'app_jouer_match')]
    public function index(CalendarRepository $calendarRepository, Request $request): Response
    {
        $currentDate = new \DateTime();

        $events = $calendarRepository->findFutureEvents($currentDate);

        $rdvs = [];

        foreach ($events as $event) {
            $createdById = null;
            $createdBy = $event->getCreatedBy();
            if ($createdBy !== null) {
                $createdById = $createdBy->getId();
            }

            $rdvs[] = [
                'id' => $event->getId(),
                'start' => $event->getStart()->format('Y-m-d H:i:s'),
                'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                'title' => $event->getTitle(),
                'description' => $event->getDescription(),
                'allDay' => $event->isAllDay(),
                'createdBy' => $createdById,
            ];
        }

        $data = json_encode($rdvs);

        return $this->render('jouer_match/index.html.twig', compact('data'));
    }
}
