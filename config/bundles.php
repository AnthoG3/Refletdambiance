<?php

return [
// Le FrameworkBundle est essentiel pour faire fonctionner Symfony.
// Ce bundle contient toutes les fonctionnalités de base de Symfony, comme le routage, la gestion des requêtes, etc.
// Il est activé dans tous les environnements (all => true).
Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],

// Le TwigBundle est responsable de l'intégration de Twig, le moteur de templates de Symfony.
// Il permet de rendre des vues dans l'application Symfony.
// Ce bundle est également activé dans tous les environnements.
Symfony\Bundle\TwigBundle\TwigBundle::class => ['all' => true],

// Le WebProfilerBundle est utilisé pour afficher la barre d'outils de débogage et le profiler (qui donne des informations détaillées sur chaque requête HTTP).
// Ce bundle est uniquement activé dans les environnements de développement (`dev`) et de test (`test`), car il est destiné à des fins de débogage.
Symfony\Bundle\WebProfilerBundle\WebProfilerBundle::class => ['dev' => true, 'test' => true],

// Le DoctrineBundle permet l'intégration de Doctrine ORM pour la gestion de la base de données dans Symfony.
// Ce bundle est activé dans tous les environnements.
Doctrine\Bundle\DoctrineBundle\DoctrineBundle::class => ['all' => true],

// Le DoctrineMigrationsBundle permet la gestion des migrations de base de données.
// Il est activé dans tous les environnements, ce qui permet d'exécuter des migrations en toute sécurité à tout moment.
Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle::class => ['all' => true],

// Le MakerBundle fournit des commandes pour générer automatiquement des classes comme des contrôleurs, des entités, des formulaires, etc.
// Il est utilisé uniquement dans l'environnement de développement (`dev`).
Symfony\Bundle\MakerBundle\MakerBundle::class => ['dev' => true],

// Le SecurityBundle permet de configurer le système de sécurité de Symfony, notamment l'authentification, les autorisations et la gestion des utilisateurs.
// Ce bundle est activé dans tous les environnements.
Symfony\Bundle\SecurityBundle\SecurityBundle::class => ['all' => true],
];
