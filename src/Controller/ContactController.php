<?php

namespace App\Controller;

use App\Service\Mail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     * 
     * $request: ce qui va permettre de récuperer les données provenant du formulaire
     * cette fonction permet de récuperer toutes les données que l'utilisateur a rentré dans le formulaire Contact
     */
    public function contact(Request $request): Response
    {

        if (($request->request->get('mail') == null)) {
            return $this->render('contact/index.html.twig');
        } else {
            Mail::envoie(
                $request->request->get('mail'),
                $request->request->get('nom'),
                $request->request->get('tel'),
                $request->request->get('objet'),
                $request->request->get('msg'),

            );
            return $this->redirectToRoute("contact");
        }
    }
}
