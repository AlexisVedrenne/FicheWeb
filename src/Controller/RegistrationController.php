<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use DateTime;
use App\Service\Mail;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/enregistrer", name="app_register")
     * 
     * Fonction générer automatiquement par symfony qui permet la création d'un nouvel utilisateur
     * @return Void
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User(); //Création d'un utilisateur vide
        $form = $this->createForm(RegistrationFormType::class, $user,array('csrf_protection' => false)); 
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
            $user->setPseudo("Vévé");
            $user->setStatutConnexion(false);
            //On inscript la date à la laquel l'utilisateur à créer son compte
            //Ici c'est la date actuel
            $user->setDateInscription(new DateTime('NOW'));
            //Ici on va utiliser doctrine pour persister les donner de l'utilisateur en base de donnée
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            Mail::envoie($user,"Bienvenue !","Félicitation la création de votre compte à été un succès\n
            Vous pouvez des maintenant accèder à votre espace client, ainsi qu'a toutes les fiches de notre site\n
            ","<h1>Cordialement l'équipe FicheWeb</h1>");

            return $this->redirectToRoute('app_login');
        }

        //Cela permet de générer la page de formulaire qui va permettre de créer un compte
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
