<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class ContactType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
$builder
->add('name', TextType::class, [
'label' => 'Nom et prénom',
'attr' => ['class' => 'form-control'],
'label_attr' => ['class' => 'form-label'],
'constraints' => [new NotBlank(['message' => 'Le nom et prénom ne peuvent pas être vides.'])],
'required' => true,
])
->add('email', EmailType::class, [
'label' => 'Email',
'attr' => ['class' => 'form-control'],
'label_attr' => ['class' => 'form-label'],
'constraints' => [new NotBlank(['message' => 'L\'email ne peut pas être vide.'])],
'required' => true,
])
->add('phone', TextType::class, [
'label' => 'Téléphone',
'attr' => ['class' => 'form-control'],
'label_attr' => ['class' => 'form-label'],
'constraints' => [
new NotBlank(['message' => 'Le numéro de téléphone ne peut pas être vide.']),
new Regex([
'pattern' => '/^0[1-9][0-9]{8}$/',
'message' => 'Veuillez entrer un numéro de téléphone valide (10 chiffres).',
]),
],
'required' => true,
])
->add('pieces', ChoiceType::class, [
'label' => 'Nb de pièces',
'attr' => ['class' => 'form-control'],
'label_attr' => ['class' => 'form-label'],
'choices' => [
'Choisissez une option' => '',
'1' => 1,
'2' => 2,
'3' => 3,
'4' => 4,
'5 et +' => 5,
],
'constraints' => [new NotBlank(['message' => 'Le nombre de pièces ne peut pas être vide.'])],
'required' => true,
])
->add('m2', IntegerType::class, [
'label' => 'Nombre de m²',
'attr' => ['class' => 'form-control'],
'label_attr' => ['class' => 'form-label'],
'constraints' => [new NotBlank(['message' => 'Le nombre de m² ne peut pas être vide.'])],
'required' => true,
])
->add('habitation', ChoiceType::class, [
'label' => 'Type d\'habitation',
'attr' => ['class' => 'form-control'],
'label_attr' => ['class' => 'form-label'],
'choices' => [
'Choisissez une option' => '',
'Appartement' => 'appartement',
'Maison' => 'maison',
'Autre' => 'autre',
],
'constraints' => [new NotBlank(['message' => 'Le type d\'habitation ne peut pas être vide.'])],
'required' => true,
])
->add('foyer', ChoiceType::class, [
'label' => 'Vous êtes ',
'attr' => ['class' => 'form-control'],
'label_attr' => ['class' => 'form-label'],
'choices' => [
'Choisissez une option' => '',
'Propriétaire' => 'proprietaire',
'Locataire' => 'locataire',
],
'constraints' => [new NotBlank(['message' => 'Le statut de foyer ne peut pas être vide.'])],
'required' => true,
])
->add('styles', ChoiceType::class, [
'label' => 'Ambiance',
'attr' => ['class' => 'form-control'],
'label_attr' => ['class' => 'form-label'],
'choices' => [
'Choisissez une option' => '',
'Cocooning' => 'cocooning',
'Pastel' => 'pastel',
'Chalet' => 'chalet',
'Marin' => 'marin',
'Méditerranéen' => 'mediterraneen',
'Bohème' => 'boheme',
'Jungle' => 'jungle',
'Végétal' => 'vegetal',
'Safari' => 'safari',
'Mexicain' => 'mexicain',
'Contemporain' => 'contemporain',
'Industriel' => 'industriel',
'Campagne' => 'campagne',
'Pop art' => 'pop_art',
'Kids bohème' => 'kids_boheme',
'Kids forêt' => 'kids_foret',
'Kids jungle' => 'kids_jungle',
'Kids savane' => 'kids_savane',
],
'constraints' => [new NotBlank(['message' => 'Le style ne peut pas être vide.'])],
'required' => true,
])
->add('formule', ChoiceType::class, [
'label' => 'Formule',
'attr' => ['class' => 'form-control'],
'label_attr' => ['class' => 'form-label'],
'choices' => [
'Choisissez une option' => '',
'Formule ambiance' => 'ambiance',
'Formule ambiance shopping' => 'ambiance/shopping',
'Formule perspective' => 'perspective',
'Formule complète' => 'complete',
'Formule à définir' => 'indefini',
],
'constraints' => [new NotBlank(['message' => 'La formule ne peut pas être vide.'])],
'required' => true,
])
->add('rappel', ChoiceType::class, [
'label' => 'Contact',
'attr' => ['class' => 'form-control'],
'label_attr' => ['class' => 'form-label'],
'choices' => [
'Choisissez une option' => '',
'Téléphone' => 'telephone',
'Mail' => 'mail',
],
'constraints' => [new NotBlank(['message' => 'Le mode de contact ne peut pas être vide.'])],
'required' => true,
])
->add('message', TextareaType::class, [
'label' => 'Description du projet',
'attr' => ['class' => 'form-control'],
'label_attr' => ['class' => 'form-label'],
'constraints' => [new NotBlank(['message' => 'Le message ne peut pas être vide.'])],
'required' => false,
]);
}

public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults([
'data_class' => Contact::class,
]);
}
}
