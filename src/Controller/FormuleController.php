<?php

namespace App\Controller;

use App\Entity\Formule;
use App\Repository\FormuleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormuleController extends AbstractController
{
// Route pour afficher la liste des formules
#[Route('/formules', name: 'app_formule_index')]
public function index(FormuleRepository $formuleRepository): Response
{
$formules = $formuleRepository->findAll();

return $this->render('formule/index.html.twig', [
'formules' => $formules,
]);
}

// Route pour afficher une formule spécifique
#[Route('/formules/{id}', name: 'app_formule_show')]
public function show(Formule $formule): Response
{
return $this->render('formule/show.html.twig', [
'formule' => $formule,
]);
}
}
