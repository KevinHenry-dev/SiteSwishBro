<?php

namespace App\Controller;

use App\Entity\Calendar;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
  /*   #[Route('/api', name: 'api')]
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    } */

    #[Route('/api/{id}/edit', name: 'api_event_edit', methods:['PUT'])]
    public function majEvent(?Calendar $calendar, Request $request): Response
    {
        // recuperer les donnees
        $donnees = json_decode($request->getContent());

        if(
            isset($donnees->title) && !empty($donnees->title) &&
            isset($donnees->start) && !empty($donnees->start) &&
            isset($donnees->description) && !empty($donnees->description) &&
            isset($donnees->end) && !empty($donnees->end) &&
            isset($donnees->allDay) && !empty($donnees->allDay) 
        
        ){
            //les donnees sont completes
            // initialisé un code 
            $code = 200;

            //verifié si l'id existe
            if(!$calendar){
                //on instancie un rdv
                $calendar = new Calendar;

                //on cange le code
                $code = 201;
            }

            //hydrater l'objet avec les donnees
            $calendar->setTitle($donnees->title);
            $calendar->setDescription($donnees->description);
            $calendar->setStart(new DateTime($donnees->start));
            if($donnees->allDay){
                $calendar->setEnd(new DateTime($donnees->start));
            }else{
                $calendar->setEnd(new DateTime($donnees->end));
            }
            $calendar->setAllDay($donnees->allDay);
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($calendar);
            $entityManager->flush();

            // retourne le code 
            return new Response('Ok', $code);
        }else{
            //les donnees sont incompletes
            return new Response('Données incompletes', 404);
        }



        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
}
