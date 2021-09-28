<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
            $longeur= 8;
            $code=AppController::codeGen($longeur); //génération du code d'authentification
            $tempCode= AppController::codeGen(4); //génération du code de nommage
            Mail::mdpOublier($request->request->get('mail'),$code); //Envoyer du code d'authentification par mail
            file_put_contents('temp/temp'.($tempCode*2).'.xml','<app><mdp><code></code><mail></mail></mdp></app>');
            $xml=simplexml_load_file('temp/temp'.($tempCode*2).'.xml');
            $xml->mdp[0]->code=$code;
            $xml->mdp[0]->mail=$request->request->get('mail');
            $xml->asXML('temp/temp'.($tempCode*2).'.xml');
            return $this->redirectToRoute('service_firewall',array('temp'=>$tempCode));
        }
    }

    /**
     * @Route("/fireWall/{temp}",name="firewall")
     */
    public function fireWallMdp(Request $request,$temp){
        $code=utf8_decode(simplexml_load_file('temp/temp'.($temp*2).'.xml')->mdp[0]->code);
        $longeur=8;
        $form=$this->createForm(ValideCodeType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $submitCode="";
            for ($i = 1; $i <= $longeur; $i++) {
                $submitCode=$submitCode."".(string)$request->request->get('digit-'.$i);
            }
             
            if($submitCode==$code){

                return $this->redirectToRoute('service_mdp',array('temp'=>$temp));
            }
            
        }
        return $this->render('service/motDePasseOublier/valideCode.html.twig',['form'=>$form->createView(),'code'=>$longeur]);
    }



    /**
     * @Route("/changementmdp/{temp}",name="mdp")
     */
    public function motDePasseOublier($temp,UserRepository $repo,Request $request,EntityManagerInterface $manager, UserPasswordEncoderInterface $passwordEncoder){
        $user=$repo->findOneBy(array('email'=>utf8_decode(simplexml_load_file('temp/temp'.($temp*2).'.xml')->mdp[0]->mail)));
        $form=$this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $user->setPassword($passwordEncoder->encodePassword($user,$user->getPassword()));
            $manager->persist($user);
            $manager->flush();
            unlink('temp/temp'.($temp*2).'.xml');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('service/motDePasseOublier/changementmdp.html.twig',['form'=>$form->createView()]);
    }
}