<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AreaController extends AbstractController
{
    #[Route('/recruteur/area', name: 'app_area_recruteur')]
    public function indexRecruteur(): Response
    {
        return $this->render('area/recruteur/index.html.twig', [
            'controller_name' => 'AreaController',
        ]);
    }

    #[Route('/candidat/area', name: 'app_area_candidat')]
    public function indexCandidat(): Response
    {
        return $this->render('area/candidat/index.html.twig', [
            'controller_name' => 'AreaController',
        ]);
    }
}
