<?php

namespace App\Controller;

use App\Entity\Inspiration;
use App\Repository\InspirationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InspirationController extends AbstractController
{
// Route pour afficher la liste des inspirations
#[Route('/inspirations', name: 'app_inspiration_index')]
public function index(InspirationRepository $inspirationRepository): Response
{
$inspirations = $inspirationRepository->findAll();

return $this->render('inspiration/index.html.twig', [
'inspirations' => $inspirations,
]);
}

// Route pour afficher une inspiration spécifique
#[Route('/inspirations/{id}', name: 'app_inspiration_show')]
public function show(Inspiration $inspiration): Response
{
return $this->render('inspiration/show.html.twig', [
'inspiration' => $inspiration,
]);
}
}
