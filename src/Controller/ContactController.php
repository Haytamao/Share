<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ContactRepository;
use App\Entity\Contact;


class ContactController extends AbstractController
{
    #[Route('/liste-contacts', name: 'app_liste_contacts')]
    public function listeContacts(ContactRepository $contactRepository): Response
    {
        $contacts = $contactRepository->findAll();
        return $this->render('contact/liste-contacts.html.twig', [
            'contacts' => $contacts
        ]);
    }
    #[Route('/lire-contact/{id}', name: 'app_lire_contact')]
    public function lireContact(Contact $contact): Response
    {
        return $this->render('contact/lire-contact.html.twig', [
            'contact'=>$contact
        ]);
    }
}
