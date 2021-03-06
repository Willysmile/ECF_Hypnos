<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Form\HotelRegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HotelInfosController extends AbstractController
{


    #[Route('/manager/hotel/', name: 'app_hotel_edit')]
    public function index(Request $request, EntityManagerInterface $entity): Response
    {

        $hotel_id = $this->getUser()->getHotel();



        if (empty($hotel_id) || $hotel_id === null) {

            return $this->render('hotel_management/NoAssignation.html.twig');
        }


        $hotel = $entity->getRepository(Hotel::class)->find($hotel_id);



        $form = $this->createForm(HotelRegistrationType::class, $hotel);
        $notification = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $entity->persist($hotel);
            $entity->flush();
        }

        return $this->render('hotel_management/index.html.twig', [

            'form' => $form->createView(),


        ]);




    }
}
