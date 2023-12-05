<?php

namespace App\Controller;

use App\Entity\Hopitaux;
use App\Repository\UserRepository;
use App\Repository\HopitauxRepository;
use App\Repository\CliniquesRepository;
use App\Repository\PharmaciesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(UserRepository $userRepository): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $users = $this->getUser();
        $users=$userRepository ->findAll();
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'users'=>$users,
        ]);
    }

    #[Route('/list_hopitaux', name: 'app_list_hopitaux')]
    public function list_hopitaux(Request $request,PaginatorInterface $paginator,HopitauxRepository $hopitauxRepository): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $users = $this->getUser();
        $pagination =$paginator->paginate($hopitauxRepository->findAllHopitauxQuery(),
        $request->query->getInt('page', 1), limit:5 /*page number*/) ;
        return $this->render('admin/list_hopitaux.html.twig', [
            'controller_name' => 'AdminController',
            'users'=>$users,
            'pagination'=>$pagination,
        ]);
    }

    #[Route('/list_cliniques', name: 'app_list_cliniques')]
    public function list_cliniques(Request $request,PaginatorInterface $paginator,CliniquesRepository $cliniquesRepository): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $users = $this->getUser();
        $pagination =$paginator->paginate($cliniquesRepository->findAllCliniquesQuery(),
        $request->query->getInt('page', 1), limit:5 /*page number*/) ;
        return $this->render('admin/list_cliniques.html.twig', [
            'controller_name' => 'AdminController',
            'pagination'=>$pagination,
            'users'=>$users,

        ]);
    }

    #[Route('/list_pharmacies', name: 'app_list_pharmacies')]
    public function list_pharmacies(Request $request,PaginatorInterface $paginator,PharmaciesRepository $pharmaciesRepository): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $users = $this->getUser();
        $pagination =$paginator->paginate($pharmaciesRepository->findAllPharmaciesQuery(),
        $request->query->getInt('page', 1), limit:5 /*page number*/) ;
        return $this->render('admin/list_pharmacies.html.twig', [
            'controller_name' => 'AdminController',
            'pagination'=>$pagination,
            'users'=>$users,
        ]);
    }

    public function search(Request $request, HopitauxRepository $hopitauxRepository,CliniquesRepository $cliniquesRepository,
    PharmaciesRepository $pharmaciesRepository): JsonResponse
    {
        $query = $request->query->get('q'); // Récupérer la requête de recherche depuis la requête GET
        $results = $hopitauxRepository->searchFullText($query); // Utilisez votre logique de recherche

        // Renvoyer les résultats au format JSON
        return $this->json($results);
    }
}
