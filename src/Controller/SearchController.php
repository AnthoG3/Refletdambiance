<?php

namespace App\Controller;

use App\Repository\FormuleRepository;
use App\Repository\InspirationRepository;
use App\Repository\RealisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'search', methods: ['GET'])]
    public function search(
        Request $request,
        FormuleRepository $formuleRepository,
        InspirationRepository $inspirationRepository,
        RealisationRepository $realisationRepository
    ): Response {
        $query = $request->query->get('q', ''); // Assurez-vous que "q" est utilisé dans le formulaire

        if (empty($query)) {
            return $this->render('search/results.html.twig', [
                'query' => $query,
                'results' => [],
            ]);
        }

        // Recherche dans les différentes entités
        $formules = $formuleRepository->searchByTerm($query);
        $inspirations = $inspirationRepository->searchByTerm($query);
        $realisations = $realisationRepository->searchByTerm($query);

        // Fusionne tous les résultats
        $results = [
            'formules' => $formules,
            'inspirations' => $inspirations,
            'realisations' => $realisations,
        ];

        return $this->render('search/results.html.twig', [
            'query' => $query,
            'results' => $results,
        ]);
    }
}