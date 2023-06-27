<?php

namespace App\Controller\Recruteur;

use App\Repository\CvRepository;
use App\Repository\CommandesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CvthequeController extends AbstractController
{
    #[Route('/recruteur/cvtheque', name: 'app_cvtheque')]
    public function index(Request $request ,CvRepository $cvRepository, CommandesRepository $commandesRepository): Response
{
    $user = $this->getUser();
    if ($user) {
        // Récupérer l'ID de l'utilisateur authentifié
        

        $finAbonnement = new \DateTimeImmutable(); // Création d'une variable $finAbonnement contenant la date actuelle

        $commandes = $commandesRepository->findOneBy(['user' => $user]);               //je récupère la commande associé(clé étrangère "users" dans la table commandes) à la clé primaire $user 

        if (isset($commandes) && $commandes->getExpireAt() > $finAbonnement) {           // if (isset($commandes) && $commandes->getExpireAt() > $finAbonnement)


//la recherche de cv est permise si un abonnement est en cours.

            $recherche = $request->query->get('search');                            // query de la variable global searchExtension

            if (!empty($recherche)) {
                $resultats = $cvRepository->trouverCv($recherche);                  // fonction du queryBuilder de cvRepository
            } else {
                $resultats = $cvRepository->findAll();
            }

            return $this->render('area/recruteur/cvtheque/index.html.twig', [
                'cvs' => $cvRepository->findAll(),
                'user' => $user,
                'resultats' => $resultats,                                              //$resultats =  cvRepository
            ]);
        } else {

            $this->addFlash('info', 'Abonnez-vous pour découvrir notre Cvthèque !');
            return $this->redirectToRoute('app_area_recruteur');
        }
    }

    // Gérer le cas où aucun utilisateur n'est authentifié
    return $this->redirectToRoute('app_home');
}


    #[Route('//search', name: 'app_search',  methods: ['GET'])]
        public function search(Request $request, CvRepository $cvRepository): Response {

            $recherche = $request->query->get('search');

            if (!empty($recherche)) {
                $resultats = $cvRepository->trouverCv($recherche);
            } else {
                $resultats = $cvRepository->findAll();
            }
            return $this->render('search/index.html.twig', [
                'resultats' => $resultats,
            ]);
        }
}
