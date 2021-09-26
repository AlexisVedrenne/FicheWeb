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
     * @Route("/fireWall",name="fireWall")
     */
    public function fireWallMdp(Request $request){
        $longeur= 8;
        $code=AppController::codeGen($longeur);
        $form=$this->createForm(ValideCodeType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            
            return $this->redirectToRoute('service_mdp');
        }
        return $this->render('service/motDePasseOublier/valideCode.html.twig',['form'=>$form->createView(),'code'=>$longeur]);
    }

    public function motDePasseOublier(UserRepository $repo, int $id,int $code,Request $request, UserPasswordEncoderInterface $passwordEncoder){
        $user=$repo->find($id);
    }
}