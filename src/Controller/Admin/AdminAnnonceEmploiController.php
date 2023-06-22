<?php

namespace App\Controller\Admin;

use App\Entity\AnnonceEmploi;
use App\Form\AdminAnnonceEmploiType;
use App\Repository\AnnonceEmploiRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/annonce')]
class AdminAnnonceEmploiController extends AbstractController
{
    #[Route('/', name: 'app_admin_annonce_emploi_index', methods: ['GET'])]
    public function index(AnnonceEmploiRepository $annonceEmploiRepository): Response
    {
        return $this->render('admin_annonce_emploi/index.html.twig', [
            'annonce_emplois' => $annonceEmploiRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_annonce_emploi_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AnnonceEmploiRepository $annonceEmploiRepository): Response
    {
        $annonceEmploi = new AnnonceEmploi();
        $form = $this->createForm(AdminAnnonceEmploiType::class, $annonceEmploi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annonceEmploi->setCreatedAt(new \DateTimeImmutable())  ;                   //creation nouvelle date et heure
            $annonceEmploiRepository->save($annonceEmploi, true);

            return $this->redirectToRoute('app_admin_annonce_emploi_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_annonce_emploi/new.html.twig', [
            'annonce_emploi' => $annonceEmploi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_annonce_emploi_show', methods: ['GET'])]
    public function show(AnnonceEmploi $annonceEmploi): Response
    {
        return $this->render('admin_annonce_emploi/show.html.twig', [
            'annonce_emploi' => $annonceEmploi,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_annonce_emploi_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AnnonceEmploi $annonceEmploi, AnnonceEmploiRepository $annonceEmploiRepository): Response
    {
        $form = $this->createForm(AdminAnnonceEmploiType::class, $annonceEmploi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annonceEmploiRepository->save($annonceEmploi, true);

            return $this->redirectToRoute('app_admin_annonce_emploi_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_annonce_emploi/edit.html.twig', [
            'annonce_emploi' => $annonceEmploi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_annonce_emploi_delete', methods: ['POST'])]
    public function delete(Request $request, AnnonceEmploi $annonceEmploi, AnnonceEmploiRepository $annonceEmploiRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$annonceEmploi->getId(), $request->request->get('_token'))) {
            $annonceEmploiRepository->remove($annonceEmploi, true);
        }

        return $this->redirectToRoute('app_admin_annonce_emploi_index', [], Response::HTTP_SEE_OTHER);
    }
}
