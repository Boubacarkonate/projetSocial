<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function sendEmail(MailerInterface $mailer, Request  $request): Response
    {

        
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();

            $from = $contactFormData['email'];
            $subject = $contactFormData['objet'];
            $name = $contactFormData['name'] ;
            $firstname = $contactFormData['firstname'] ;
            $message = $contactFormData['message'];
           $phone = $contactFormData['telephone'];
            
       
            $email = (new TemplatedEmail())
        ->from($from)
        ->to('admin@gmail.com')
        //->cc('cc@example.com')
        //->bcc('bcc@example.com')
        //->replyTo('fabien@example.com')
        //->priority(Email::PRIORITY_HIGH)
        ->subject($subject)
        ->text('Sending emails is fun again!')
        ->htmlTemplate('contact/email.html.twig')
        ->context([
            'from' => $from,
            'phone' => $phone,
            'name' => $name,
            'firstname'=> $firstname,
            'subject' => $subject,
            'message' => $message,

        ]);

    $mailer->send($email);


        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
   
    }
}
