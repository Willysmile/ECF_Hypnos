<?php

namespace App\Controller;

use App\Entity\ImagesSuite;
use App\Entity\Suite;
use App\Form\SuiteType;
use App\Repository\ImagesSuiteRepository;
use App\Repository\SuiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/manager/hotel/suite')]
class ManagerSuiteController extends AbstractController
{
    #[Route('/', name: 'app_manager_suite_index', methods: ['GET'])]
    public function index(SuiteRepository $suiteRepository): Response
    {

        $hotel_id = $this->getUser()->getHotel();

        if (empty($hotel_id) || $hotel_id === null) {

            return $this->render('hotel_registration/NoAssignation.html.twig');
        }

        $manager_suite = $suiteRepository->findby(['hotel' => $hotel_id]);


        return $this->render('manager_suite/index.html.twig', [
            'suites' => $manager_suite,

        ]);
    }

    #[Route('/new', name: 'app_manager_suite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entity): Response
    {
        $suite = new Suite();
        $form = $this->createForm(SuiteType::class, $suite);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $hotel_id = $this->getUser()->getHotel();
            $suite->setHotel($hotel_id);
            $images = $form->get('images')->getData();


            foreach ($images as $image) {

                $fichier = md5(uniqid()) . '.' . $image->guessExtension();


                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );

                // On crée l'image dans la base de données
                $img = new ImagesSuite();
                $img->setName($fichier);
                $suite->addImage($img);
            }


            $entity->persist($suite);
            $entity->flush();

            return $this->redirectToRoute('app_manager_suite_index', [],Response::HTTP_SEE_OTHER);
        }

       return $this->renderForm('manager_suite/new.html.twig', [
            'suite' => $suite,
            'form' => $form]);
    }

    #[Route('/{id}', name: 'app_manager_suite_show', methods: ['GET'])]
    public function show(Suite $suite): Response
    {


        return $this->render('manager_suite/show.html.twig', [
            'suite' => $suite,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_manager_suite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Suite $suite, EntityManagerInterface $entity): Response
    {


        $form = $this->createForm(SuiteType::class, $suite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $images = $form->get('images')->getData();


            foreach ($images as $image) {

                $fichier = md5(uniqid()) . '.' . $image->guessExtension();


                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );

                // On crée l'image dans la base de données
                $img = new ImagesSuite();
                $img->setName($fichier);
                $suite->addImage($img);
            }


            $entity->persist($suite);
            $entity->flush();


        }


        return $this->renderForm('manager_suite/edit.html.twig', [
            'suite' => $suite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_manager_suite_delete', methods: ['POST'])]
    public function delete(Request $request, Suite $suite, SuiteRepository $suiteRepository): Response
    {

        if ($this->isCsrfTokenValid('delete' . $suite->getId(), $request->request->get('_token'))) {
            $suiteRepository->remove($suite);
        }

        return $this->redirectToRoute('app_manager_suite_index', [],Response::HTTP_SEE_OTHER);
    }

    #[Route('/images/{id}', name: 'app_manager_image_delete', methods: ['POST'])]
    public function Imagesdelete(Request $request, ImagesSuite $image, ImagesSuiteRepository $suiteRepository): Response
    {
        $url = $request->server->get("HTTP_REFERER")
        ;
        if ($this->isCsrfTokenValid('delete' . $image->getId(), $request->request->get('_token'))) {
            $suiteRepository->remove($image);
        }

        return $this->redirect($url);
    }
}
