<?php

namespace App\Controller;

use App\Repository\CommentaireRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CommentaireRepository $commentaireRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'commentaires' => $commentaireRepository->findAll(),
        ]);
    }
}
