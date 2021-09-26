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
use App\Form\ValideCodeType;
use App\Service\Mail;
use XMLWriter;

/**
     * @Route("/service", name="service_")
     */
class ServiceController extends AbstractController
{
    
    public function index(): Response
    {
        return $this->render('service/index.html.twig', [
            'controller_name' => 'ServiceController',
        ]);
    }


    /**
     * @Route("/motDePasseOublier",name="demande")
     */
    public function dmdMdp(Request $request){ 
        
        if( ($request->request->get('mail')==null)){
            return $this->render('service/motDePasseOublier/demandeMail.html.twig');
        }
        else{
            $longeur= 8;
            $code=AppController::codeGen($longeur);
            // Mail::mdpOublier($request->request->get('mail'),$code);
            $xml=new XMLWriter();
            $xml->openUri("varableglobal.xml");
            $xml->startElement('mdp');
            $xml->writeElement('code',$code);
            $xml->endElement();
            $xml->flush();
            return $this->redirectToRoute('service_firewall');
        }
    }

    /**
     * @Route("/fireWall",name="firewall")
     */
    public function fireWallMdp(Request $request){
        $code=utf8_decode(simplexml_load_file("varableglobal.xml")->{"code"});
        var_dump($code);
        $longeur=8;
        $form=$this->createForm(ValideCodeType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $submitCode="";
            for ($i = 1; $i <= $longeur; $i++) {
                $submitCode=$submitCode."".(string)$request->request->get('digit-'.$i);
            }
             
            if($submitCode==$code){
                return $this->redirectToRoute('service_mdp');
            }
            
        }
        return $this->render('service/motDePasseOublier/valideCode.html.twig',['form'=>$form->createView(),'code'=>$longeur]);
    }


    
    public function motDePasseOublier(UserRepository $repo, int $id,int $code,Request $request, UserPasswordEncoderInterface $passwordEncoder){
        $user=$repo->find($id);
    }
}