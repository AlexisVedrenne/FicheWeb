<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\ORM\EntityManagerInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/connexion", name="app_login")
     * Cette fonction générer automatiquement permet de se connecter à l'application
     * 
     * @return void 
     */
    public function login(AuthenticationUtils $authenticationUtils,EntityManagerInterface $manager): Response
    {

        $user=$this->getUser();
        //Ici on determine si l'utilisateur est déjà connecter
        //Si oui on le redirige sur la page d'acceuil
        if ($user) {
            //Ces lignes de code permette de mettre à jour le status d'un utilisateur en base de donnée
            //De hors à en ligne (false or true)
            $user->setStatutConnexion(true);
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('home');
        }

        //Récupére la potentiel erreur lors de la connexion
        $error = $authenticationUtils->getLastAuthenticationError();

        //Permet de récupérer le dernier nom utilisateur entrée
        $lastUsername = $authenticationUtils->getLastUsername();

        //Cette ligne représente la page qui va permettre de se connecter
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     * 
     * Cette fonctione permet de se deconnecter du site/deconnecter un utilisateur
     * @return void
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
