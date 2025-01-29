<?php

// Vérifie si le fichier App_KernelProdContainer.preload.php existe dans le répertoire de cache pour l'environnement de production (prod).
// Ce fichier est généralement généré lors du cache de l'application pour optimiser les performances en production.
if (file_exists(dirname(__DIR__).'/var/cache/prod/App_KernelProdContainer.preload.php')) {
    // Si le fichier existe, il est inclus (requi).
    // Cela permet de charger les préchargements ou optimisations spécifiques à l'environnement de production.
    require dirname(__DIR__).'/var/cache/prod/App_KernelProdContainer.preload.php';
}
