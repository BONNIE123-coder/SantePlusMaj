<?php

namespace App\Controller;

use App\Entity\Hopitaux;
use App\Form\HopitauxType;
use App\Repository\HopitauxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/hopitaux')]
class HopitauxController extends AbstractController
{
    #[Route('/', name: 'app_hopitaux_index', methods: ['GET'])]
    public function index(HopitauxRepository $hopitauxRepository): Response
    {
        return $this->render('hopitaux/index.html.twig', [
            'hopitauxes' => $hopitauxRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_hopitaux_new', methods: ['GET', 'POST'])]
    public function new(Request $request, HopitauxRepository $hopitauxRepository): Response
    {
        $hopitaux = new Hopitaux();
        $form = $this->createForm(HopitauxType::class, $hopitaux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hopitauxRepository->save($hopitaux, true);

            return $this->redirectToRoute('app_hopitaux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hopitaux/new.html.twig', [
            'hopitaux' => $hopitaux,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hopitaux_show', methods: ['GET'])]
    public function show(Hopitaux $hopitaux): Response
    {
        return $this->render('hopitaux/show.html.twig', [
            'hopitaux' => $hopitaux,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_hopitaux_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Hopitaux $hopitaux, HopitauxRepository $hopitauxRepository): Response
    {
        $form = $this->createForm(HopitauxType::class, $hopitaux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hopitauxRepository->save($hopitaux, true);

            return $this->redirectToRoute('app_hopitaux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hopitaux/edit.html.twig', [
            'hopitaux' => $hopitaux,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hopitaux_delete', methods: ['POST'])]
    public function delete(Request $request, Hopitaux $hopitaux, HopitauxRepository $hopitauxRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hopitaux->getId(), $request->request->get('_token'))) {
            $hopitauxRepository->remove($hopitaux, true);
        }

        return $this->redirectToRoute('app_hopitaux_index', [], Response::HTTP_SEE_OTHER);
    }

}
