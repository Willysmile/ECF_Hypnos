<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookingformType;
use App\Form\ContactFormType;
use App\Repository\HotelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingRegistrationController extends AbstractController
{
    #[Route('/booking/registration', name: 'app_booking_registration')]
    public function index(Request $request, EntityManagerInterface $entity): Response
    {



$user = $this->getUser();







        $booking = new Booking();

        $form = $this->createForm(BookingformType::class,$booking);

        $notification = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $booking->setCustomer($user);
            $entity->persist($booking);
            $entity->flush();
        }

            return $this->render('booking_registration/index.html.twig', [
                'form' => $form->createView(),

            ]);
        }

}
