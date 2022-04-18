<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookingformType;
use App\Repository\BookingRepository;
use App\Repository\HotelRepository;
use App\Repository\SuiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingRegistrationController extends AbstractController
{
    #[Route('/booking/registration', name: 'app_booking_registration')]
    public function index(Request $request, SuiteRepository $suiteRepository, EntityManagerInterface $entity, HotelRepository $hotelRepository): Response
    {

        $hotel = $hotelRepository->findAll();

        $notification = null;
        $user = $this->getUser();
        $booking = new Booking();
        $form = $this->createForm(BookingformType::class, $booking);



        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $idSuite = $request->request->get('suite');
            $booking->setSuite($suiteRepository->find(['id' => $idSuite]));
            $booking->setCustomer($user);
            $entity->persist($booking);
            $entity->flush();
        }

        return $this->render('booking_registration/index.html.twig', [
            'form' => $form->createView(),
            'hotels' => $hotel,

            'notification' => $notification

        ]);

    }

    #[Route('/suite/api/', name: 'app_api', methods: ["GET"])]
    public function findSuite(SuiteRepository $suiteRepository)
    {

        $listeSuite = $suiteRepository->findAll();
        $listeResponse = array();
        foreach ($listeSuite as $suite) {
            $listeResponse[] = array(
                'id' => $suite->getId(),
                'name' => $suite->getName(),
                'night_price' => $suite->getNightPrice(),
                'hotel_id' => $suite->getHotel()->getId(),
            );
        }
        $response = new Response();
        $response->setContent(json_encode(array('suite'=>$listeResponse)));
        $response->headers->set("Content-Type", "application/json");
        $response->headers->set("Access-Control-Allow-Origin", "*");
        return $response;
    }


    #[Route('/{id}', name: 'app_booking_delete', methods: ['POST'])]
    public function delete(Request $request, Booking $booking, BookingRepository $bookingRepository): Response
    {

        if ($this->isCsrfTokenValid('delete' . $booking->getId(), $request->request->get('_token'))) {
            $bookingRepository->remove($booking);
        }

        return $this->redirectToRoute('app_customer_view_booking', [], Response::HTTP_SEE_OTHER);
    }
}
