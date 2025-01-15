<?php

namespace App\Controller;

use App\Entity\Realisation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RealisationController extends AbstractController
{
    #[Route('/realisation', name: 'app_realisation')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $realisations = $entityManager->getRepository(Realisation::class)->findAll();

        return $this->render('realisation/index.html.twig', [
            'realisations' => $realisations,
        ]);
    }

    #[Route('/realisation/{id}', name: 'app_realisation_show')]
    public function show(Realisation $realisation): Response
    {
        return $this->render('realisation/show.html.twig', [
            'realisation' => $realisation,
        ]);
    }
}
