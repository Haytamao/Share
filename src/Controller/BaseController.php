<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\CategorieType;
use App\Entity\Categorie;

class BaseController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('base/index.html.twig', [
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request,EntityManagerInterface $em): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class,$contact);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
                $contact->setDateEnvoi(new \Datetime());
                $em->persist($contact);
                $em->flush();
                $this->addFlash('notice','Message envoyé');
                return $this->redirectToRoute('app_contact');
            }
            }
        return $this->render('base/contact.html.twig',[
            'form' => $form->createView()
        ]);
        }
    
    #[Route('/a_Propos', name: 'app_a_Propos')]
    public function a_Propos(): Response
    {
        return $this->render('base/a_Propos.html.twig',[
    
        ]);
        }
    #[Route('/mentions_legales', name: 'app_mentions_legales')]
    public function mentions_legales(): Response
    {
        return $this->render('base/mentions_legales.html.twig',[
        
        ]);
        }
        #[Route('/Categorie', name: 'app_categorie')]
    public function categorie(Request $request,EntityManagerInterface $em): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class,$categorie);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
                $em->persist($categorie);
                $em->flush();
                $this->addFlash('notice','Message envoyé');
                return $this->redirectToRoute('app_categorie');
            }
            }
        return $this->render('base/categorie.html.twig',[
            'form' => $form->createView()
        ]);
        }
}