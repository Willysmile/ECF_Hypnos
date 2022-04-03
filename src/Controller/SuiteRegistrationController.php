<?php

namespace App\Controller;


use App\Entity\Suite;
use App\Form\CustomerRegistrationType;
use App\Form\SuiteRegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SuiteRegistrationController extends AbstractController
{
    #[Route('/suite/création', name: 'app_suite_registration')]
    public function index(Request $request, EntityManagerInterface $entity): Response
    {
        $suite = new Suite();

        $form = $this->createForm(SuiteRegistrationType::class, $suite);
        $notification = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $entity->persist($suite);
            $entity->flush();



        }


        return $this->render('suite_registration/index.html.twig', ['form' => $form->createView()]
        );


    }
}
