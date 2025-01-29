<?php

// Importation de la classe Kernel depuis l'espace de noms "App"
use App\Kernel;

// Inclusion du fichier "autoload_runtime.php" qui charge automatiquement les classes nécessaires de Composer
require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

// Fonction de retour qui prend un tableau $context comme argument
return function (array $context) {
    // Retourne une nouvelle instance de la classe Kernel, en passant les variables de configuration
    // "APP_ENV" et "APP_DEBUG" du contexte pour initialiser l'environnement et le mode de débogage.
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
