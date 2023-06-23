<?php

namespace App\Controller\PresentationMetiers;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PresentationMetiersExpertiseController extends AbstractController
{
    #[Route('/presentation/metiers/expertise', name: 'app_presentation_metiers_expertise')]
    public function index(): Response
    {
        return $this->render('metiers/presentation_metiers_expertise/index.html.twig', []);
    }
}
