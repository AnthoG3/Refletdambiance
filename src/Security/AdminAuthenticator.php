<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface; // Interface pour le token d'authentification
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class AdminAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'admin_login';

    public function __construct(private readonly UrlGeneratorInterface $urlGenerator)
    {
    }

    public function authenticate(Request $request): Passport
    {
        // Récupération de l'email de l'utilisateur dans la requête HTTP
        $email = $request->request->get('email', '');
        // Enregistrement de l'email dans la session pour pouvoir l'afficher dans le formulaire lors d'un nouvel essai de connexion
        $request->getSession()->set(Security::LAST_USERNAME, $email);

        // Création du Passport qui contient les informations nécessaires à l'authentification
        return new Passport(
        // Création d'un UserBadge basé sur l'email (identifiant de l'utilisateur)
            new UserBadge($email),
            // Création des Credentials avec le mot de passe saisi dans le formulaire
            new PasswordCredentials($request->request->get('password', '')),
            [
                // Ajout du CSRF token pour vérifier la sécurité du formulaire
                new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),
            ]
        );
    }

    // Cette méthode est appelée si l'authentification réussit
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {

        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }

        // On redirige l'utilisateur vers le tableau de bord d'administration
        return new RedirectResponse($this->urlGenerator->generate('app_admin_dashboard'));
    }

    // Retourne l'URL de la page de connexion
    protected function getLoginUrl(Request $request): string
    {
        // Utilise le générateur d'URL pour renvoyer l'URL de la page de connexion admin
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
