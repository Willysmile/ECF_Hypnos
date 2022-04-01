<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\Manager;
use App\Form\CustomerRegistrationType;
use App\Form\ManagerRegistrationType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ManagerRegistrationController extends AbstractController
{
    #[Route('/admin/manager/inscription', name: 'app_manager_registration')]
    public function index(Request $request, UserPasswordHasherInterface $encoder, EntityManagerInterface $entity): Response
    {
        $user = new Manager();
        $form = $this->createForm(ManagerRegistrationType::class, $user);
        $notification = null;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->hashPassword($user, $user->getPassword());
            $user->setPassword($hash);

            $entity->persist($user);
            $entity->flush();



        }




        return $this->render('manager_registration/index.html.twig', [
            'controller_name' => 'ManagerRegistrationController',
            'form' => $form->createView()


        ]);
    }
}
