<?php

namespace App\Controller;

use App\Entity\Hotel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HotelViewController extends AbstractController
{
    #[Route('/hotel/{id}', name: 'app_hotel_view')]
    public function index(Hotel $hotel): Response
    {
        $suites = $hotel->getSuite();



        return $this->render('hotel_view/index.html.twig', [
            'hotel' => $hotel,
            'suites' => $suites,
        ]);
    }
}
