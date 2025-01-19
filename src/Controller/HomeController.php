<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        // Création d'un nouvel objet Contact
        $contact = new Contact();

        // Création du formulaire basé sur l'entité Contact
        $form = $this->createForm(ContactType::class, $contact);

        // Traitement de la soumission du formulaire
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {

            // Création de l'email à envoyer
            $email = (new Email())
                ->from('contact@refletdambiance.fr')
                ->to('anthony.gevers@lapiscine.pro')
                ->subject('Vous avez une nouvelle demande de contact')
                ->html(
                    '<html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        color: #333;
                    }
                    .email-container {
                        max-width: 600px;
                        margin: 0 auto;
                        background-color: #fff;
                        padding: 20px;
                        border-radius: 10px;
                        box-shadow: 0 0 10px rgba(0,0,0,0.1);
                    }
                    h2 {
                    color: #aeaf62;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }
                    td {
                        padding: 10px;
                        border-bottom: 1px solid #ddd;
                    }
                    .label {
                        font-weight: bold;
                    }
                </style>
            </head>
            <body>
                <div class="email-container">
                    <h2>Nouveau message de contact</h2>
                    <table>
                        <tr>
                            <td class="label">Nom :</td>
                            <td>' . htmlspecialchars($contact->getName()) . '</td>
                        </tr>
                        <tr>
                            <td class="label">Email :</td>
                            <td>' . htmlspecialchars($contact->getEmail()) . '</td>
                        </tr>
                        <tr>
                            <td class="label">Téléphone :</td>
                            <td>' . htmlspecialchars($contact->getPhone()) . '</td>
                        </tr>
                        <tr>
                            <td class="label">Nb de pièces :</td>
                            <td>' . htmlspecialchars($contact->getPieces()) . '</td>
                        </tr>
                        <tr>
                            <td class="label">M² :</td>
                            <td>' . htmlspecialchars($contact->getM2()) . '</td>
                        </tr>
                        <tr>
                            <td class="label">Habitation :</td>
                            <td>' . htmlspecialchars($contact->getHabitation()) . '</td>
                        </tr>
                        <tr>
                            <td class="label">Foyer :</td>
                            <td>' . htmlspecialchars($contact->getFoyer()) . '</td>
                        </tr>
                        <tr>
                            <td class="label">Style :</td>
                            <td>' . htmlspecialchars($contact->getStyles()) . '</td>
                        </tr>
                        <tr>
                            <td class="label">Formule :</td>
                            <td>' . htmlspecialchars($contact->getFormule()) . '</td>
                        </tr>
                        <tr>
                            <td class="label">Rappel :</td>
                            <td>' . htmlspecialchars($contact->getRappel()) . '</td>
                        </tr>
                        <tr>
                            <td class="label">Message :</td>
                            <td>' . nl2br(htmlspecialchars($contact->getMessage())) . '</td>
                        </tr>
                    </table>
                </div>
            </body>
        </html>'
                );

            // Envoi de l'email via le service Mailer
            $mailer->send($email);

            // Message flash pour indiquer le succès de l'envoi
            $this->addFlash('success', 'Votre message a été envoyé avec succès.');

            // Redirection vers la page d'accueil pour afficher un formulaire vide
            return $this->redirectToRoute('home');
        }

        // Affichage du formulaire dans la vue si le formulaire n'est pas soumis ou non valide
        return $this->render('home.html.twig', [
            'contactForm' => $form->createView(),
        ]);
    }
}
