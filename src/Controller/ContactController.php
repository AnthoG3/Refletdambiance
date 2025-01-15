<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/', name: 'app_home', methods: ['GET', 'POST'])]
    public function home(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer les styles depuis le formulaire (déjà une string)
            $styles = $form->get('styles')->getData() ?? '';

            // Création de l'Email avec le contenu HTML
            $email = (new Email())
                ->from('contact@refletdambiance.fr')
                ->to('anthony.gevers@lapiscine.pro')
                ->subject('Une demande de contact a été faite')
                ->html("
                    <p>Prénom et nom : {$contact->getName()}</p>
                    <p>Email : {$contact->getEmail()}</p>
                    <p>Téléphone : {$contact->getPhone()}</p>
                    <p>Nombre de pièces : {$contact->getPieces()}</p>
                    <p>Nombre de m² : {$contact->getM2()}</p>
                    <p>Type d'habitation : {$contact->getHabitation()}</p>
                    <p>Vous êtes : {$contact->getFoyer()}</p>
                    <p>Quelle(s) ambiance(s) souhaitez-vous : {$styles}</p>
                    <p>Message : {$contact->getMessage()}</p>
                ");

            $mailer->send($email);

            $this->addFlash('success', 'Message envoyé avec succès !');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('home.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
