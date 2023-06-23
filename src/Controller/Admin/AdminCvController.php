<?php

namespace App\Controller\Admin;

use App\Entity\Cv;
use App\Repository\CvRepository;
use App\Form\AdminForm\AdminCvType;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
#[IsGranted("ROLE_ADMIN")]
#[Route('/admin/cv')]
class AdminCvController extends AbstractController
{
    #[Route('/', name: 'app_admin_cv_index', methods: ['GET'])]
    public function index(CvRepository $cvRepository): Response
    {
        return $this->render('admin/admin_cv/index.html.twig', [
            'cvs' => $cvRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_cv_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CvRepository $cvRepository, FileUploader $fileUploader): Response
    {
        $user = $this->getUser();
        $cv = new Cv();

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

            return $this->redirectToRoute('app_admin_cv_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/admin_cv/new.html.twig', [
            'cv' => $cv,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_cv_show', methods: ['GET'])]
    public function show(Cv $cv): Response
    {
        return $this->render('admin/admin_cv/show.html.twig', [
            'cv' => $cv,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_admin_cv_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cv $cv, CvRepository $cvRepository): Response
    {
        $form = $this->createForm(AdminCvType::class, $cv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $cv->setUpdatedAt(new \DateTimeImmutable());

            $cvRepository->save($cv, true);

            return $this->redirectToRoute('app_admin_cv_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/admin_cv/edit.html.twig', [
            'cv' => $cv,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_cv_delete', methods: ['POST'])]
    public function delete(Request $request, Cv $cv, CvRepository $cvRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cv->getId(), $request->request->get('_token'))) {
            $cvRepository->remove($cv, true);
        }

        return $this->redirectToRoute('app_admin_cv_index', [], Response::HTTP_SEE_OTHER);
    }
}
