<?php

namespace App\Controller\Candidat;

use App\Entity\AnnonceEmploi;
use App\Repository\AnnonceEmploiRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/candidat/annonce')]
class AnnonceController extends AbstractController
{
    #[Route('/', name: 'app_area_candidat_annonce_index')]
    public function index(AnnonceEmploiRepository $annonceEmploiRepository): Response
    {
        return $this->render('area/candidat/annonce/index.html.twig', [
            'annonces' => $annonceEmploiRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_area_candidat_annonce_show', methods: ['GET'])]
    public function show(AnnonceEmploi $annonceEmploi): Response
    {
        return $this->render('area/candidat/annonce/show.html.twig', [
            'annonce' => $annonceEmploi,
        ]);
    }
}
