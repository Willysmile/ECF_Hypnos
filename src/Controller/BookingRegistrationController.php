<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Suite;
use App\Form\BookingformType;
use App\Form\ContactFormType;
use App\Repository\BookingRepository;
use App\Repository\HotelRepository;
use App\Repository\SuiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingRegistrationController extends AbstractController
{
    #[Route('/booking/registration', name: 'app_booking_registration')]
    public function index(Request $request, SuiteRepository $suiteRepository, EntityManagerInterface $entity, HotelRepository $hotelRepository): Response
    {

        $hotel = $hotelRepository->findAll();
        $suites = $suiteRepository->findAll();

        $user = $this->getUser();
        $booking = new Booking();
        $form = $this->createForm(BookingformType::class,$booking);



        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entity->setUser($user);
            $entity->persist($booking);
            $entity->flush();
        }

            return $this->render('booking_registration/index.html.twig', [
                'form' => $form->createView(),
                'hotels' => $hotel,
                'suites' => $suites

            ]);
        }
    #[Route('/{id}', name: 'app_booking_delete', methods: ['POST'])]
    public function delete(Request $request, Booking $booking, BookingRepository $bookingRepository): Response
    {

        if ($this->isCsrfTokenValid('delete' . $booking->getId(), $request->request->get('_token'))) {
            $bookingRepository->remove($booking);
        }

        return $this->redirectToRoute('app_customer_view_booking', [],Response::HTTP_SEE_OTHER);
    }
}
