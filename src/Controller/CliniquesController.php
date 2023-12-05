<?php

namespace App\Controller;

use App\Entity\Cliniques;
use App\Form\CliniquesType;
use App\Repository\CliniquesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cliniques')]
class CliniquesController extends AbstractController
{
    #[Route('/', name: 'app_cliniques_index', methods: ['GET'])]
    public function index(CliniquesRepository $cliniquesRepository): Response
    {
        return $this->render('cliniques/index.html.twig', [
            'cliniques' => $cliniquesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cliniques_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CliniquesRepository $cliniquesRepository): Response
    {
        $clinique = new Cliniques();
        $form = $this->createForm(CliniquesType::class, $clinique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cliniquesRepository->save($clinique, true);

            return $this->redirectToRoute('app_cliniques_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cliniques/new.html.twig', [
            'clinique' => $clinique,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cliniques_show', methods: ['GET'])]
    public function show(Cliniques $clinique): Response
    {
        return $this->render('cliniques/show.html.twig', [
            'clinique' => $clinique,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cliniques_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cliniques $clinique, CliniquesRepository $cliniquesRepository): Response
    {
        $form = $this->createForm(CliniquesType::class, $clinique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cliniquesRepository->save($clinique, true);

            return $this->redirectToRoute('app_cliniques_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cliniques/edit.html.twig', [
            'clinique' => $clinique,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cliniques_delete', methods: ['POST'])]
    public function delete(Request $request, Cliniques $clinique, CliniquesRepository $cliniquesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$clinique->getId(), $request->request->get('_token'))) {
            $cliniquesRepository->remove($clinique, true);
        }

        return $this->redirectToRoute('app_cliniques_index', [], Response::HTTP_SEE_OTHER);
    }
}
