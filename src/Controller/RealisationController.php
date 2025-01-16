<?php
namespace App\Controller;

use App\Entity\Realisation;
use App\Repository\RealisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RealisationController extends AbstractController
{
// Route pour afficher la liste des réalisations
#[Route('/realisations', name: 'app_realisation_index')]
public function index(RealisationRepository $realisationRepository): Response
{
// Récupérer toutes les réalisations
$realisations = $realisationRepository->findAll();

return $this->render('realisation/index.html.twig', [
'realisations' => $realisations,
]);
}

// Route pour afficher une réalisation spécifique
#[Route('/realisations/{id}', name: 'app_realisation_show')]
public function show(Realisation $realisation): Response
{
return $this->render('realisation/show.html.twig', [
'realisation' => $realisation,
]);
}
}
