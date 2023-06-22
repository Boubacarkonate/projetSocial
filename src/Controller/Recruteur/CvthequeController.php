<?php

namespace App\Controller\Recruteur;

use App\Repository\CvRepository;
use App\Repository\CommandesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CvthequeController extends AbstractController
{
    #[Route('/recruteur/cvtheque', name: 'app_cvtheque')]
    public function index(CvRepository $cvRepository, CommandesRepository $commandesRepository): Response
{
    $user = $this->getUser();
    if ($user) {
        // Récupérer l'ID de l'utilisateur authentifié
        

        $finAbonnement = new \DateTimeImmutable(); // Création d'une variable $finAbonnement contenant la date actuelle

        $commandes = $commandesRepository->findOneBy(['user' => $user]);               //je récupère la commande associé(clé étrangère "users" dans la table commandes) à la clé primaire $user 

        if (isset($commandes) && $commandes->getExpireAt() > $finAbonnement) {           // if (isset($commandes) && $commandes->getExpireAt() > $finAbonnement)
            return $this->render('area/recruteur/cvtheque/index.html.twig', [
                'cvs' => $cvRepository->findAll(),
                'user' => $user
            ]);
        } else {

            $this->addFlash('info', 'Abonnez-vous pour découvrir notre Cvthèque !');
            return $this->redirectToRoute('app_area_recruteur');
        }
    }

    // Gérer le cas où aucun utilisateur n'est authentifié
    return $this->redirectToRoute('app_home');
}
}
