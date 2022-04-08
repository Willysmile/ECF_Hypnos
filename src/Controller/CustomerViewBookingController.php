<?php

namespace App\Controller;

use App\Repository\BookingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerViewBookingController extends AbstractController
{
    #[Route('/customer/view/booking/', name: 'app_customer_view_booking')]
    public function index(BookingRepository $booking): Response
    {
        $user = $this->getUser()->getId();



        $bookings = $booking->findBy(['customer' => $user]);

;
        return $this->render('customer_view_booking/index.html.twig', [
            'bookings' => $bookings,

        ]);
    }

}
