<?php

namespace App\Controller;

use App\Entity\Formule;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormuleController extends AbstractController
{
    #[Route('/formules', name: 'app_formules')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $formules = $entityManager->getRepository(Formule::class)->findAll();

        return $this->render('formule/index.html.twig', [
            'formules' => $formules,
        ]);
    }

    #[Route('/formule', name: 'app_formule')]
    public function formule(): Response
    {
        return $this->redirectToRoute('app_formules');
    }

    #[Route('/formule/{id}', name: 'app_formule_show')]
    public function show(Formule $formule): Response
    {
        return $this->render('formule/show.html.twig', [
            'formule' => $formule,
        ]);
    }
}
