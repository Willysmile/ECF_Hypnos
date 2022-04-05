<?php

namespace App\Controller;

use App\Form\ContactFormType;
use App\Form\HotelRegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactFormController extends AbstractController
{
    #[Route('/contact/form', name: 'app_contact_form')]
    public function index(Request $request, MailerInterface $mailer): Response
    {


        $form = $this->createForm(ContactFormType::class);
        $notification = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();


            $mail = (new Email())
                ->from($contact['email'])
                ->to('admin@test.fr')
                ->subject($contact['sujet'])
                ->text($contact['message'])
            ;

            $mailer->send($mail);


        }



        return $this->render('contact_form/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}