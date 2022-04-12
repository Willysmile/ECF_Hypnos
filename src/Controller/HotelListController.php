<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Repository\HotelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HotelListController extends AbstractController
{
    #[Route('/etablissements', name: 'app_hotel_list')]
    public function index(HotelRepository $hotelRepository): Response
    {
        $hotels = $hotelRepository->findAll();
        return $this->render('hotel_list/index.html.twig', [
            'hotels' => $hotels
        ]);
    }
}
