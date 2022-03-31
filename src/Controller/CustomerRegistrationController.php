<?php

namespace App\Controller;


use App\Entity\Customer;
use App\Form\CustomerRegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class CustomerRegistrationController extends AbstractController
{
    #[Route('/clients/inscription', name: 'app_customer_registration')]
    public function index(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $encoder): Response
    {
        $user = new Customer();
        $form = $this->createForm(CustomerRegistrationType::class, $user);
        $notification = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->hashPassword($user, $user->getPassword());
            $user->setPassword($hash);

            $manager->persist($user);
            $manager->flush();



        }


        return $this->render('customer_registration/index.html.twig', ['form' => $form->createView()]
        );
    }
}
