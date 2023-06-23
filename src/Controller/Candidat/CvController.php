<?php

namespace App\Controller\Candidat;

use App\Entity\Cv;
use App\Form\CvType;
use App\Repository\CvRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/candidat/cv')]
class CvController extends AbstractController
{
    #[Route('/', name: 'app_cv_index', methods: ['GET'])]
    public function index(CvRepository $cvRepository): Response
    {
        $user = $this->getUser();                           //récupération de données de l'user connecté

        $cv = $cvRepository->findBy([                       //récupération des données du champ user de l'entité annonceEmploiRepository    
            'user' => $user,
           
        ]);

        return $this->render('area/candidat/cv/index.html.twig', [
            'user' => $user,
            'cv' => $cv,
        ]);
    }

    #[Route('/new', name: 'app_cv_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CvRepository $cvRepository, FileUploader $fileUploader): Response
    {   
        $cv = new Cv();
        $user = $this->getUser();
        

        if($user){
            
            $cv->setUser($user);                    //affichera l'user correspondant
          }

        
        $form = $this->createForm(CvType::class, $cv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $cv ->setCreatedAt(new \DateTimeImmutable());             //creation nouvelle date et heure
            $cv->setUser($this->getUser());
            $cvChampForm = $form->get('cv_candidat')->getData();

            if ($cvChampForm) {
                
                $cvTelecharge = $fileUploader->upload($cvChampForm);

                $cv->setCvCandidat($cvTelecharge);
          
            }

            $cvRepository->save($cv, true);
            return $this->redirectToRoute('app_cv_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('area/candidat/cv/new.html.twig', [
            'cv' => $cv,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cv_show', methods: ['GET'])]
    public function show(Cv $cv): Response
    {
        return $this->render('area/candidat/cv/show.html.twig', [
            'cv' => $cv,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_cv_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cv $cv, CvRepository $cvRepository, FileUploader $fileUploader): Response
    {
      
        
        $form = $this->createForm(CvType::class, $cv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $cv ->setUpdatedAt(new \DateTimeImmutable());             //creation nouvelle date et heure
            $cv->setUser($this->getUser());
            $cvChampForm = $form->get('cv_candidat')->getData();

            if ($cvChampForm) {
                
                $cvTelecharge = $fileUploader->upload($cvChampForm);

                $cv->setCvCandidat($cvTelecharge);
          
            }
            $cvRepository->save($cv, true);

            return $this->redirectToRoute('app_cv_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('area/candidat/cv/edit.html.twig', [
            'cv' => $cv,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cv_delete', methods: ['POST'])]
    public function delete(Request $request, Cv $cv, CvRepository $cvRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cv->getId(), $request->request->get('_token'))) {
            $cvRepository->remove($cv, true);
        }

        return $this->redirectToRoute('app_cv_index', [], Response::HTTP_SEE_OTHER);
    }
}
