<?php

namespace App\Controller;

use App\Repository\HopitauxRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    /**
     * @Route("/recherche", name="search")
     */
    public function search(Request $request, HopitauxController $hopitauxController, HopitauxRepository $hopitauxRepository)
    {
        $query = $request->query->get('q'); // Récupérer la requête de recherche depuis la requête GET
        $results = $hopitauxRepository->searchHopitaux($query); // Utilisez votre logique de recherche

        return $this->render('search/index.html.twig', [
            'results' => $results,
        ]);
    }
}