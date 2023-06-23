<?php

namespace App\Controller\Recruteur;

use App\Entity\AnnonceEmploi;
use App\Form\AnnonceEmploiType;
use App\Repository\AnnonceEmploiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/recruteur/annonce')]
class AnnonceEmploiController extends AbstractController
{
    #[Route('/', name: 'app_annonce_emploi_index', methods: ['GET'])]
    public function index(AnnonceEmploiRepository $annonceEmploiRepository): Response
    {
        $user = $this->getUser();                           //récupération de données de l'user connecté

        $annonce = $annonceEmploiRepository->findBy([                       //récupération des données du champ user de l'entité annonceEmploiRepository    
            'user' => $user
        ]);
        
        return $this->render('area/recruteur/annonce_emploi/index.html.twig', [
                'annonce'=>$annonce,
                'user' => $user,
        ]);
    }

    #[Route('/new', name: 'app_annonce_emploi_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AnnonceEmploiRepository $annonceEmploiRepository): Response
    {
        $annonceEmploi = new AnnonceEmploi();

        $user = $this->getUser();

        if($user){
            
            $annonceEmploi->setUser($user);                    //affichera l'user correspondant
          }

        
        $form = $this->createForm(AnnonceEmploiType::class, $annonceEmploi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $annonceEmploi->setCreatedAt(new \DateTimeImmutable());
            $annonceEmploiRepository->save($annonceEmploi, true);

            $this->addFlash('succes', 'Votre annonce a bien été enregistré !');

            return $this->redirectToRoute('app_annonce_emploi_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('area/recruteur/annonce_emploi/new.html.twig', [
            'annonce_emploi' => $annonceEmploi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_annonce_emploi_show', methods: ['GET'])]
    public function show(AnnonceEmploi $annonceEmploi): Response
    {
        return $this->render('area/recruteur/annonce_emploi/show.html.twig', [
            'annonce_emploi' => $annonceEmploi,
        ]);
    }

    #[Route('edit/{id}/', name: 'app_annonce_emploi_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AnnonceEmploi $annonceEmploi, AnnonceEmploiRepository $annonceEmploiRepository): Response
    {
        $form = $this->createForm(AnnonceEmploiType::class, $annonceEmploi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annonceEmploiRepository->save($annonceEmploi, true);

            $this->addFlash('succes', 'Votre annonce a bien été enregistré !');

            return $this->redirectToRoute('app_annonce_emploi_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('area/recruteur/annonce_emploi/edit.html.twig', [
            'annonce_emploi' => $annonceEmploi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_annonce_emploi_delete', methods: ['POST'])]
    public function delete(Request $request, AnnonceEmploi $annonceEmploi, AnnonceEmploiRepository $annonceEmploiRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$annonceEmploi->getId(), $request->request->get('_token'))) {
            $annonceEmploiRepository->remove($annonceEmploi, true);
        }

        $this->addFlash('danger', 'Votre annonce a bien été supprimé !');

        return $this->redirectToRoute('app_annonce_emploi_index', [], Response::HTTP_SEE_OTHER);
    }
}
