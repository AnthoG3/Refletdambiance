<?php

namespace App\Controller;

use App\Service\SearchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function search(Request $request, SearchService $searchService)
    {
        $searchTerm = $request->query->get('search');

        if ($searchTerm) {
            // Utiliser le service de recherche pour rechercher sur tout le site
            $results = $searchService->searchByTerm($searchTerm);
        } else {
            $results = [];
        }

        return $this->render('search/results.html.twig', [
            'results' => $results,
            'search' => $searchTerm,
        ]);
    }
}

