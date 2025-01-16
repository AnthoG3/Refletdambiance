<?php

namespace App\Controller\Admin;

use App\Entity\Realisation;
use App\Entity\Formule;
use App\Entity\Inspiration;
use App\Form\RealisationType;
use App\Form\FormuleType;
use App\Form\InspirationType;
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

    #[Route('/{entityType}/create', name: 'app_admin_entity_create')]
    public function createEntity(
        string $entityType,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $entityClass = match ($entityType) {
            'realisation' => Realisation::class,
            'formule' => Formule::class,
            'inspiration' => Inspiration::class,
            default => throw $this->createNotFoundException("Type d'entité invalide."),
        };

        $formClass = match ($entityType) {
            'realisation' => RealisationType::class,
            'formule' => FormuleType::class,
            'inspiration' => InspirationType::class,
        };

        $entity = new $entityClass();
        $form = $this->createForm($formClass, $entity);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $newFilename = uniqid() . '.' . $imageFile->guessExtension();
                $imageFile->move(
                    $this->getParameter($entityType . 's_directory'),
                    $newFilename
                );
                $entity->setImage($newFilename);
            }

            $entity->setCreatedAt(new \DateTime());
            $entityManager->persist($entity);
            $entityManager->flush();

            $this->addFlash('success', ucfirst($entityType) . " ajouté avec succès.");

            return $this->redirectToRoute('app_admin_dashboard');
        }

        return $this->render('admin/admin_dashboard/create.html.twig', [
            'form' => $form->createView(),
            'entity_type' => $entityType,
        ]);
    }

    #[Route('/{entityType}/{id}/edit', name: 'app_admin_entity_edit')]
    public function editEntity(
        string $entityType,
        int $id,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $entityClass = match ($entityType) {
            'realisation' => Realisation::class,
            'formule' => Formule::class,
            'inspiration' => Inspiration::class,
            default => throw $this->createNotFoundException("Type d'entité invalide."),
        };

        $formClass = match ($entityType) {
            'realisation' => RealisationType::class,
            'formule' => FormuleType::class,
            'inspiration' => InspirationType::class,
        };

        $entity = $entityManager->getRepository($entityClass)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException(ucfirst($entityType) . " introuvable.");
        }

        $form = $this->createForm($formClass, $entity);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $newFilename = uniqid() . '.' . $imageFile->guessExtension();
                $imageFile->move(
                    $this->getParameter($entityType . 's_directory'),
                    $newFilename
                );
                $entity->setImage($newFilename);
            }

            $entityManager->flush();

            $this->addFlash('success', ucfirst($entityType) . " modifié avec succès.");

            return $this->redirectToRoute('app_admin_dashboard');
        }

        return $this->render('admin/admin_dashboard/edit.html.twig', [
            'form' => $form->createView(),
            'entity_type' => $entityType,
        ]);
    }

    #[Route('/{entityType}/{id}', name: 'app_admin_entity_show')]
    public function showEntity(
        string $entityType,
        int $id,
        EntityManagerInterface $entityManager
    ): Response {
        $entityClass = match ($entityType) {
            'realisation' => Realisation::class,
            'formule' => Formule::class,
            'inspiration' => Inspiration::class,
            default => throw $this->createNotFoundException("Type d'entité invalide."),
        };

        $entity = $entityManager->getRepository($entityClass)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException(ucfirst($entityType) . " introuvable.");
        }

        return $this->render('admin/admin_dashboard/show.html.twig', [
            'entity' => $entity,
            'entity_type' => $entityType,
        ]);
    }

    #[Route('/{entityType}/{id}/delete', name: 'app_admin_entity_delete')]
    public function deleteEntity(
        string $entityType,
        int $id,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $entityClass = match ($entityType) {
            'realisation' => Realisation::class,
            'formule' => Formule::class,
            'inspiration' => Inspiration::class,
            default => throw $this->createNotFoundException("Type d'entité invalide."),
        };

        $entity = $entityManager->getRepository($entityClass)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException(ucfirst($entityType) . " introuvable.");
        }

        if ($this->isCsrfTokenValid('delete' . $entity->getId(), $request->request->get('_token'))) {
            $entityManager->remove($entity);
            $entityManager->flush();

            $this->addFlash('success', ucfirst($entityType) . " supprimé avec succès.");
        }

        return $this->redirectToRoute('app_admin_dashboard');
    }
}
