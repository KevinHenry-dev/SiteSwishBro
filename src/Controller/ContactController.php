<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;


class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $manager, MailerInterface $mailer): Response
    {
        $contact = new Contact();

      /*    if ($this->getUser()) {
            $contact->setNom($this->getUser()->getNom())
            ->setPrenom($this->getUser()->getPrenom())
            ->setEmail($this->getUser()->getEmail());
        }   */
        

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
        $contact = $form->getData();
        
        $manager->persist($contact);
        $manager->flush();

        //Email
        $email = (new TemplatedEmail())
            ->from($contact->getEmail())
            ->to('admin@swishbro.com')
            ->subject($contact->getSubject())
            ->htmlTemplate('emails/contact.html.twig')


        
            // pass variables (name => value) to the template
            ->context([
                'contact' => $contact
            ])
        ;
            
            

        $mailer->send($email);

        $this->addFlash('success','Votre demande a bien été envoyé');
            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form -> createView(),
        ]);
    }
}
