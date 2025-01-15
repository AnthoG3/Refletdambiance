<?php

namespace App\Controller;

use App\Entity\Inspiration;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InspirationController extends AbstractController
{
    #[Route('/inspiration', name: 'app_inspiration')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $inspirations = $entityManager->getRepository(Inspiration::class)->findAll();

        return $this->render('inspiration/index.html.twig', [
            'inspirations' => $inspirations,
        ]);
    }

    #[Route('/inspiration/{id}', name: 'app_inspiration_show')]
    public function show(Inspiration $inspiration): Response
    {
        return $this->render('inspiration/show.html.twig', [
            'inspiration' => $inspiration,
        ]);
    }
}
