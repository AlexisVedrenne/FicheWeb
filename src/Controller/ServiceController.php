<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Controller\AppController;
use App\Form\UserType;
use App\Form\ValideCodeType;
use App\Service\Mail;
use Doctrine\ORM\EntityManagerInterface;

/**
     * @Route("/service", name="service_")
     */
class ServiceController extends AbstractController
{
    
    // public function index(): Response
    // {
    //     return $this->render('service/index.html.twig', [
    //         'controller_name' => 'ServiceController',
    //     ]);
    // }


    /**
     * @Route("/motDePasseOublier",name="demande")
     * Cette fonction permet de générer la demmande de mot de passe.
     * Une fois l'adresse mail renseigner, la fonction va générer un code qui 
     * servivra d'authentification et sera envoyer par mail. Elle va également créer un fichier temporaire
     * puis générer un deuxième codes qui va service à nommer le fichier temporaire. Qui lui contiendra le code
     * d'authentification et l'email de l'utilisateur.
     */
    public function dmdMdp(Request $request){ 
        
        if( ($request->request->get('mail')==null)){
            return $this->render('service/motDePasseOublier/demandeMail.html.twig');
        }
        else{
            $longeur= 6;
            $code=AppController::codeGen($longeur); //génération du code d'authentification
            $tempCode= AppController::codeGen(4); //génération du code de nommage
            Mail::mdpOublier($request->request->get('mail'),$code); //Envoyer du code d'authentification par mail
            file_put_contents('temp/temp'.($tempCode*2).'.xml','<app><mdp><code></code><mail></mail></mdp></app>'); //création du fichier temporaire
            $xml=simplexml_load_file('temp/temp'.($tempCode*2).'.xml'); //Lecture du fichier 
            $xml->mdp[0]->code=$code; //Enregistrement du code d'authentification
            $xml->mdp[0]->mail=$request->request->get('mail');//Enregistrement du mail
            $xml->asXML('temp/temp'.($tempCode*2).'.xml'); //Enregistrement du fichier
            return $this->redirectToRoute('service_firewall',array('temp'=>$tempCode));
        }
    }

    /**
     * @Route("/fireWall/{temp}",name="firewall")
     * Cette fonction sert de "firewall" au changement de mot de passe. Cette page permet d'entrée le mot de passe qui
     * à été envoyer par email. Et vérirife si le code correpond.
     * 
     * @return void
     */
    public function fireWallMdp(Request $request,$temp){
        $code=utf8_decode(simplexml_load_file('temp/temp'.($temp*2).'.xml')->mdp[0]->code); //Récupération du code enregistrer dans le fichier temporaire
        $longeur=6;
        $form=$this->createForm(ValideCodeType::class); //Création du formulaire qui permetra de le valider
        $form->handleRequest($request); //Récupération du formulaire
        if($form->isSubmitted()&&$form->isValid()){ //Test pour savoir si le formulaire à bien été envoyer et s'il est valide
            $submitCode=""; //Variable qui va récuperer le code
            for ($i = 1; $i <= $longeur; $i++) {
                $submitCode=$submitCode."".(string)$request->request->get('digit-'.$i); //Récupération et ajout de chaque digit du code
            }
             
            if($submitCode==$code){

                return $this->redirectToRoute('service_mdp',array('temp'=>$temp)); //Si le code correspond alors on redirige sur la page de changement de mot de passe
            }
            
        }
        return $this->render('service/motDePasseOublier/valideCode.html.twig',['form'=>$form->createView(),'code'=>$longeur]); //Création de la vue qui affiche le formulaire
    }



    /**
     * @Route("/changementmdp/{temp}",name="mdp")
     * Cette fonction permet de changer le mot de passe et supprime le fichier temporaire qui à été créer.
     */
    public function motDePasseOublier($temp,UserRepository $repo,Request $request,EntityManagerInterface $manager, UserPasswordEncoderInterface $passwordEncoder){
        $user=$repo->findOneBy(array('email'=>utf8_decode(simplexml_load_file('temp/temp'.($temp*2).'.xml')->mdp[0]->mail)));//Cette ligne permet de 
        // récupérer l'utilisateur en base de donnée en fonction de l'email renseigner au départ
        $form=$this->createForm(UserType::class,$user); //Créer le formulaire de changement de mot de passe
        $form->handleRequest($request); // Récupération du formulaire  
        if($form->isSubmitted()&&$form->isValid()){ //Test pour savoir si le formulaire à bien été envoyer et s'il est valide
            $user->setPassword($passwordEncoder->encodePassword($user,$user->getPassword()));
            $manager->persist($user); //Ajout du l'utilisateur dans la file des mises à jours
            $manager->flush(); //Application de la ou les mises à jour en base de donnée
            unlink('temp/temp'.($temp*2).'.xml'); //Suppression du fichier temporaire
            return $this->redirectToRoute('app_login'); //Redirection sur la page de connexion
        }

        return $this->render('service/motDePasseOublier/changementmdp.html.twig',['form'=>$form->createView()]);
    }
}