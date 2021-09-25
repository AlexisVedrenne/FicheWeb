<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\LoginAuthenticator;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/enregistrer", name="app_register")
     * 
     * Fonction générer automatiquement par symfony qui permet la création d'un nouvel utilisateur
     * @return Void
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginAuthenticator $authenticator): Response
    {
        $user = new User(); //Création d'un utilisateur vide
        $form = $this->createForm(RegistrationFormType::class, $user); 
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Ici on récupere le formulaire envoyer et valider par l'application
            //Et on va idrater les information de l'utilisateur dans la variable créer précédement
            //En suite en va crypter le mot de passe
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            //On définit le statut de connexion de l'utilisateur à vrai
            //Car une fois le compte créer on est automatiquement connecter
            $user->setStatutConnexion(true);
            //On inscript la date à la laquel l'utilisateur à créer son compte
            //Ici c'est la date actuel
            $user->setDateInscription(new DateTime('NOW'));
            //Ici on va utiliser doctrine pour persister les donner de l'utilisateur en base de donnée
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        //Cela permet de générer la page de formulaire qui va permettre de créer un compte
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
