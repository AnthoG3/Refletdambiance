<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

class AdminLoginType extends AbstractType // Classe représentant le formulaire de connexion pour l'administrateur
{
    // Méthode principale pour construire le formulaire
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [ // Ajout d'un champ de type email
                'label' => 'Email', // Libellé affiché à côté du champ
                'attr' => ['placeholder' => 'Email'], // Attribut HTML pour le placeholder du champ
                'label_attr' => ['class' => 'control-label'],
                'constraints' => [ // Liste des contraintes de validation pour ce champ
                    new NotBlank(['message' => 'Veuillez entrer votre adresse email.']),
                    // Vérifie que le champ n'est pas vide, sinon affiche le message
                    new Email(['message' => 'Veuillez entrer une adresse email valide.']),
                    // Vérifie que le champ contient une adresse email valide
                ],
            ])
            ->add('password', PasswordType::class, [ // Ajout d'un champ de type mot de passe
                'label' => 'Mot de passe', // Libellé affiché à côté du champ
                'attr' => ['placeholder' => 'Mot de passe'], // Placeholder pour le champ
                'label_attr' => ['class' => 'control-label'],
                'constraints' => [ // Liste des contraintes de validation pour ce champ
                    new NotBlank(['message' => 'Veuillez entrer votre mot de passe.']),
                    // Vérifie que le champ n'est pas vide
                ],
            ])
        ;
        // Le formulaire contient donc deux champs : email et mot de passe, chacun avec des contraintes spécifiques.
    }

    // Méthode pour configurer les options par défaut du formulaire
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([

        ]);
    }
}
