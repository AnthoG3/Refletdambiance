<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

// Définition de la classe AdminLoginController, qui hérite de AbstractController
//Gestion des réponses HTTP.
//Génération de routes.
//Rendu de templates.
//Accès à des services via le conteneur de dépendances.
class AdminLoginController extends AbstractController
{
    // Définition de la route pour la page de connexion de l'administrateur, avec l'annotation #[Route]
    #[Route('/admin/login', name: 'admin_login')]  // Cette route est associée à l'URL '/admin/login' et à l'action 'admin_login'
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Vérifie si l'utilisateur est déjà connecté grâce à la méthode getUser(). Si un utilisateur est connecté, on le redirige vers le tableau de bord de l'administrateur.
        if ($this->getUser()) {
            return $this->redirectToRoute('app_admin_dashboard');  // Redirige l'utilisateur connecté vers le tableau de bord
        }

        // Récupère l'erreur d'authentification s'il y en a une, via la méthode getLastAuthenticationError() d'AuthenticationUtils
        $error = $authenticationUtils->getLastAuthenticationError();

        // Récupère le dernier nom d'utilisateur (email) saisi par l'utilisateur dans le formulaire de connexion
        $lastUsername = $authenticationUtils->getLastUsername();

        // Si une erreur d'authentification est présente, un message flash est ajouté pour informer l'utilisateur des identifiants invalides
        if ($error) {
            $this->addFlash('error', 'Identifiants invalides.');
        }

        // Rend la vue de la page de connexion en envoyant les variables nécessaires au template Twig
        // 'last_username' contient l'email du dernier utilisateur qui a tenté de se connecter
        // 'error' contient l'erreur d'authentification si elle existe
        return $this->render('admin/admin_login/index.html.twig', [
            'last_username' => $lastUsername,  // Le dernier email saisi est passé à la vue
            'error' => $error,  // L'erreur d'authentification (s'il y en a une) est passée à la vue
        ]);
    }

    // Définition de la route pour la déconnexion de l'administrateur
    #[Route('/admin/logout', name: 'admin_logout')]  // La route pour déconnecter l'administrateur
    public function logout(): void
    {
        // Cette méthode est vide car la déconnexion est gérée par Symfony automatiquement grâce à son système de sécurité
        throw new \LogicException();
    }
}
