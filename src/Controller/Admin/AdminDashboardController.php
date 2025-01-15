<?php

namespace App\Controller\Admin;

use App\Entity\Realisation;
use App\Entity\Formule;
use App\Entity\Inspiration;
use App\Form\RealisationType;
use App\Form\FormuleType;
use App\Form\InspirationType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminDashboardController extends AbstractController
{
    #[Route('', name: 'app_admin_dashboard')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $realisations = $entityManager->getRepository(Realisation::class)->findAll();
        $formules = $entityManager->getRepository(Formule::class)->findAll();
        $inspirations = $entityManager->getRepository(Inspiration::class)->findAll();

        return $this->render('admin/admin_dashboard/index.html.twig', [
            'realisations' => $realisations,
            'formules' => $formules,
            'inspirations' => $inspirations,
        ]);
    }

    // Méthodes pour Realisation
    #[Route('/realisation/create', name: 'app_admin_realisation_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $realisation = new Realisation();
        $form = $this->createForm(RealisationType::class, $realisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $newFilename = uniqid().'.'.$imageFile->guessExtension();
                $imageFile->move(
                    $this->getParameter('realisations_directory'),
                    $newFilename
                );
                $realisation->setImage($newFilename);
            } else {
                $realisation->setImage('default.jpg');
            }

            $realisation->setCreatedAt(new DateTime());
            $entityManager->persist($realisation);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_dashboard');
        }

        return $this->render('admin/admin_dashboard/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/realisation/{id}/edit', name: 'app_admin_realisation_edit')]
    public function edit(Request $request, Realisation $realisation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RealisationType::class, $realisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                if ($realisation->getImage()) {
                    $oldFilename = $this->getParameter('realisations_directory') . '/' . $realisation->getImage();
                    if (file_exists($oldFilename)) {
                        unlink($oldFilename);
                    }
                }

                $newFilename = uniqid().'.'.$imageFile->guessExtension();
                $imageFile->move(
                    $this->getParameter('realisations_directory'),
                    $newFilename
                );
                $realisation->setImage($newFilename);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_admin_dashboard');
        }

        return $this->render('admin/admin_dashboard/edit.html.twig', [
            'form' => $form->createView(),
            'realisation' => $realisation,
        ]);
    }

    #[Route('/realisation/{id}/delete', name: 'app_admin_realisation_delete')]
    public function delete(Request $request, Realisation $realisation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$realisation->getId(), $request->request->get('_token'))) {
            if ($realisation->getImage() && $realisation->getImage() !== 'default.jpg') {
                $imagePath = $this->getParameter('realisations_directory') . '/' . $realisation->getImage();
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $entityManager->remove($realisation);
            $entityManager->flush();

            $this->addFlash('success', 'La réalisation a été supprimée avec succès.');
        }

        return $this->redirectToRoute('app_admin_dashboard');
    }


    // Méthodes pour Formule
    #[Route('/formule/create', name: 'app_admin_formule_new')]
    public function newFormule(Request $request, EntityManagerInterface $entityManager): Response
    {
        $formule = new Formule();
        $form = $this->createForm(FormuleType::class, $formule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $newFilename = uniqid().'.'.$imageFile->guessExtension();
                $imageFile->move(
                    $this->getParameter('formules_directory'),
                    $newFilename
                );
                $formule->setImage($newFilename);
            }

            $formule->setCreatedAt(new \DateTimeImmutable());
            $entityManager->persist($formule);
            $entityManager->flush();
            return $this->redirectToRoute('app_admin_dashboard');
        }

        return $this->render('admin/admin_dashboard/formule_new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/formule/{id}/edit', name: 'app_admin_formule_edit')]
    public function editFormule(Request $request, Formule $formule, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FormuleType::class, $formule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $newFilename = uniqid().'.'.$imageFile->guessExtension();
                $imageFile->move(
                    $this->getParameter('formules_directory'),
                    $newFilename
                );
                $formule->setImage($newFilename);
            }

            $entityManager->flush();
            return $this->redirectToRoute('app_admin_dashboard');
        }

        return $this->render('admin/admin_dashboard/formule_edit.html.twig', [
            'form' => $form->createView(),
            'formule' => $formule,
        ]);
    }

    #[Route('/formule/{id}/delete', name: 'app_admin_formule_delete')]
    public function deleteFormule(Request $request, Formule $formule, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formule->getId(), $request->request->get('_token'))) {
            $entityManager->remove($formule);
            $entityManager->flush();

            $this->addFlash('success', 'La formule a été supprimée avec succès.');
        }

        return $this->redirectToRoute('app_admin_dashboard');
    }


    // Méthodes pour Inspiration
    #[Route('/inspiration/create', name: 'app_admin_inspiration_new')]
    public function newInspiration(Request $request, EntityManagerInterface $entityManager): Response
    {
        $inspiration = new Inspiration();
        $form = $this->createForm(InspirationType::class, $inspiration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $newFilename = uniqid().'.'.$imageFile->guessExtension();
                $imageFile->move(
                    $this->getParameter('inspirations_directory'),
                    $newFilename
                );
                $inspiration->setImage($newFilename);
            }

            $inspiration->setCreatedAt(new \DateTimeImmutable());
            $entityManager->persist($inspiration);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_dashboard');
        }

        return $this->render('admin/admin_dashboard/inspiration_new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/inspiration/{id}/edit', name: 'app_admin_inspiration_edit')]
    public function editInspiration(Request $request, Inspiration $inspiration, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InspirationType::class, $inspiration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $newFilename = uniqid().'.'.$imageFile->guessExtension();
                $imageFile->move(
                    $this->getParameter('inspirations_directory'),
                    $newFilename
                );
                $inspiration->setImage($newFilename);
            }
            $entityManager->flush();
            return $this->redirectToRoute('app_admin_dashboard');
        }

        return $this->render('admin/admin_dashboard/inspiration_edit.html.twig', [
            'form' => $form->createView(),
            'inspiration' => $inspiration,
        ]);
    }

    #[Route('/inspiration/{id}/delete', name: 'app_admin_inspiration_delete')]
    public function deleteInspiration(Request $request, Inspiration $inspiration, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inspiration->getId(), $request->request->get('_token'))) {
            $entityManager->remove($inspiration);
            $entityManager->flush();

            $this->addFlash('success', 'L\'inspiration a été supprimée avec succès.');
        }

        return $this->redirectToRoute('app_admin_dashboard');
    }

}
