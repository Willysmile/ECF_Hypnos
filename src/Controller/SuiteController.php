<?php

namespace App\Controller;

use App\Entity\Suite;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SuiteController extends AbstractController
{
    #[Route('/suite/{id}', name: 'app_suite_view')]
    public function index(Suite $suite): Response
    {



        return $this->render('suite_view/index.html.twig', [
            'suite' => $suite
        ]);
    }
}
