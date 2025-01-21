<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminLoginController extends AbstractController
{
    #[Route('/admin/login', name: 'admin_login')]  // La route pour afficher la page de connexion
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Si l'utilisateur est déjà connecté, on le redirige vers le tableau de bord
        if ($this->getUser()) {
            return $this->redirectToRoute('app_admin_dashboard');
        }

        // Récupère l'erreur d'authentification, s'il y en a une
        $error = $authenticationUtils->getLastAuthenticationError();
        // Récupère le dernier email saisi par l'utilisateur dans le formulaire de connexion
        $lastUsername = $authenticationUtils->getLastUsername();

        // Si une erreur d'authentification est présente, un message flash est ajouté pour informer l'utilisateur
        if ($error) {
            $this->addFlash('error', 'Identifiants invalides.');
        }

        // Renvoie le formulaire de connexion avec les variables pour afficher le dernier email et l'erreur
        return $this->render('admin/admin_login/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/admin/logout', name: 'admin_logout')]  // La route de déconnexion
    public function logout(): void
    {
        // Cette méthode peut rester vide car elle sera interceptée par Symfony lors de la déconnexion
        throw new \LogicException();
    }
}
