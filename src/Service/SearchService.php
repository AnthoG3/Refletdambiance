<?php

namespace App\Service;

use App\Repository\FormuleRepository;
use App\Repository\InspirationRepository;
use App\Repository\RealisationRepository;

class SearchService
{
    private $formuleRepository;
    private $inspirationRepository;
    private $realisationRepository;

    public function __construct(
        FormuleRepository     $formuleRepository,
        InspirationRepository $inspirationRepository,
        RealisationRepository $realisationRepository
    )
    {
        $this->formuleRepository = $formuleRepository;
        $this->inspirationRepository = $inspirationRepository;
        $this->realisationRepository = $realisationRepository;
    }

    public function searchByTerm(string $term)
    {
        // Initialisation du tableau de résultats
        $results = [];

        // Recherche dans les réalisations
        $results['realisation'] = $this->realisationRepository->searchByTerm($term);
        dump($results['realisation']); // Affiche les résultats des réalisations

        // Recherche dans les formules
        $results['formule'] = $this->formuleRepository->searchByTerm($term);
        dump($results['formule']); // Affiche les résultats des formules

        // Recherche dans les inspirations
        $results['inspiration'] = $this->inspirationRepository->searchByTerm($term);
        dump($results['inspiration']); // Affiche les résultats des inspirations

        return $results;
    }
}
