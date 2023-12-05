<?php

namespace App\Controller;

use App\Entity\Pharmacies;
use App\Form\PharmaciesType;
use App\Repository\PharmaciesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pharmacies')]
class PharmaciesController extends AbstractController
{
    #[Route('/', name: 'app_pharmacies_index', methods: ['GET'])]
    public function index(PharmaciesRepository $pharmaciesRepository): Response
    {
        return $this->render('pharmacies/index.html.twig', [
            'pharmacies' => $pharmaciesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_pharmacies_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PharmaciesRepository $pharmaciesRepository): Response
    {
        $pharmacy = new Pharmacies();
        $form = $this->createForm(PharmaciesType::class, $pharmacy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pharmaciesRepository->save($pharmacy, true);

            return $this->redirectToRoute('app_pharmacies_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pharmacies/new.html.twig', [
            'pharmacy' => $pharmacy,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pharmacies_show', methods: ['GET'])]
    public function show(Pharmacies $pharmacy): Response
    {
        return $this->render('pharmacies/show.html.twig', [
            'pharmacy' => $pharmacy,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_pharmacies_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pharmacies $pharmacy, PharmaciesRepository $pharmaciesRepository): Response
    {
        $form = $this->createForm(PharmaciesType::class, $pharmacy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pharmaciesRepository->save($pharmacy, true);

            return $this->redirectToRoute('app_pharmacies_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pharmacies/edit.html.twig', [
            'pharmacy' => $pharmacy,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pharmacies_delete', methods: ['POST'])]
    public function delete(Request $request, Pharmacies $pharmacy, PharmaciesRepository $pharmaciesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pharmacy->getId(), $request->request->get('_token'))) {
            $pharmaciesRepository->remove($pharmacy, true);
        }

        return $this->redirectToRoute('app_pharmacies_index', [], Response::HTTP_SEE_OTHER);
    }
}
