<?php

namespace App\Controller;

use App\Repository\CliniquesRepository;
use App\Repository\HopitauxRepository;
use App\Repository\PharmaciesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(HopitauxRepository $hopitauxRepository,CliniquesRepository $cliniquesRepository,
    PharmaciesRepository $pharmaciesRepository): Response
    {
        $hopitaux=$hopitauxRepository->count([]);
        $cliniques=$cliniquesRepository->count([]);
        $pharmacies=$pharmaciesRepository->count([]);
        $clients=0;
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'hopitaux'=>$hopitaux,
            'cliniques'=>$cliniques,
            'pharmacies'=>$pharmacies,
        ]);
    }

    #[Route('/list_hopitaux_part', name: 'app_liste_hopitaux_part')]
    public function list_hopitaux(HopitauxRepository $hopitauxRepository): Response
    {
        
        $hopitaux=$hopitauxRepository ->findAll();
        return $this->render('home/liste_hopitaux_part.html.twig', [
            'controller_name' => 'HomeController',
            'hopitaux'=>$hopitaux,
        ]);
    }

    #[Route('/list_cliniques_part', name: 'app_liste_cliniques_part')]
    public function list_cliniques(CliniquesRepository $cliniquesRepository): Response
    {
        
        $cliniques=$cliniquesRepository ->findAll();
        return $this->render('home/liste_cliniques_part.html.twig', [
            'controller_name' => 'HomeController',
            'cliniques'=>$cliniques,
        ]);
    }

    #[Route('/list_pharmacies_part', name: 'app_liste_pharmacies_part')]
    public function list_pharmacies(PharmaciesRepository $pharmaciesRepository): Response
    {
        
        $pharmacies=$pharmaciesRepository ->findAll();
        return $this->render('home/liste_pharmacies_part.html.twig', [
            'controller_name' => 'HomeController',
            'pharmacies'=>$pharmacies,
        ]);
    }
}
