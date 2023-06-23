<?php

namespace App\Controller\PresentationMetiers;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PresentationMetiersEducationanimationController extends AbstractController
{
    #[Route('/presentation/metiers/education_animation', name: 'app_presentation_metiers_educationanimation')]
    public function index(): Response
    {
        return $this->render('metiers/presentation_metiers_educationanimation/index.html.twig', []);
    }
}
