<?php

namespace App\Controller;

use App\Form\ContactFormType;
use App\Form\HotelRegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactFormController extends AbstractController
{
    #[Route('/contact/form', name: 'app_contact_form')]
    public function index(Request $request): Response
    {


        $form = $this->createForm(ContactFormType::class);
        $notification = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
        }



        return $this->render('contact_form/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
