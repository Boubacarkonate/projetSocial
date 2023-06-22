<?php

namespace App\Controller\Recruteur;

use App\Entity\Forfait;
use App\Repository\ForfaitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/recruteur/forfait')]
class ForfaitController extends AbstractController
{
    #[Route('/', name: 'app_forfait_index', methods: ['GET'])]
    public function index(ForfaitRepository $forfaitRepository): Response
    {
        return $this->render('area/recruteur/forfait/index.html.twig', [
            'forfaits' => $forfaitRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_forfait_show', methods: ['GET'])]
    public function show(Forfait $forfait): Response
    {
        return $this->render('area/recruteur/forfait/show.html.twig', [
            'forfait' => $forfait,
        ]);
    }

}
