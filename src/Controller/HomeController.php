<?php

namespace App\Controller;

use App\Repository\HotelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(HotelRepository $hotelrepository): Response
    {
        $hotels = $hotelrepository->findAll();

        return $this->render('home/index.html.twig', [
            'hotels' => $hotels,
        ]);
    }
}
