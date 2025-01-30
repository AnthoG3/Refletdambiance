<?php

namespace App\Command;

use App\Entity\Admin;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:create-admin',
    description: 'Creates a new admin user'
)]
class CreateAdminCommand extends Command
{
    // Constructeur de la classe, injecte l'EntityManager et le PasswordHasher
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher
    ) {
        parent::__construct(); // Appelle le constructeur de la classe parente
    }

    // Configure la commande en ajoutant des arguments requis
    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'The email of the admin')
            ->addArgument('password', InputArgument::REQUIRED, 'The password of the admin');
    }

    // Exécute la logique de la commande
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Création d'une instance SymfonyStyle pour une sortie stylisée
        $io = new SymfonyStyle($input, $output);
        // Récupération des arguments fournis par l'utilisateur
        $email = $input->getArgument('email');
        $plainPassword = $input->getArgument('password');

        // Création d'un nouvel objet Admin
        $admin = new Admin();
        // Définition de l'email de l'admin
        $admin->setEmail($email);
        // Hachage du mot de passe et définition de celui-ci
        $admin->setPassword($this->passwordHasher->hashPassword($admin, $plainPassword));
        // Définition du rôle de l'admin
        $admin->setRoles(['ROLE_ADMIN']);

        // Persistance de l'admin dans la base de données
        $this->entityManager->persist($admin);
        $this->entityManager->flush(); // Enregistrement des changements

        // Affichage d'un message de succès
        $io->success('Admin user created successfully!');

        return Command::SUCCESS;
    }
}
