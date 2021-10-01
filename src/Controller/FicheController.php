<?php

namespace App\Controller;

use App\Repository\FicheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\FicheType;
use App\Entity\Fiche;
use DateTime;
use DateTimeInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Categorie;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
* @Route("/fiche", name="fiche_")
*/
class FicheController extends AbstractController
{
    
        public function index(): Response
        {
            return $this->render('fiche/index.html.twig', [
                'controller_name' => 'FicheController',
            ]);
        }

        /**
         * @Route("/ajout",name="add")
         * 
         */
        public function addFiche(Request $request, EntityManagerInterface $manager )
        {
            
            $fiche= new Fiche();
            $form=$this->createForm(FicheType::class,$fiche);
            $form->handleRequest($request);
            if($form->isSubmitted() and $form->isValid()){


                $manager->persist($fiche);
                $manager->flush();
                //var_dump($fiche);
                // return $this->redirectToRoute('fiche_add');

            }
            return $this->render('fiche/ajouter.html.twig',['form'=>$form->createView()]);

        }

        
       








        /**
         * @Route("/edit/{id}", name="edit")
         * c'est une fonction qui permet de modifier une fiche (nom/catégorie)
         */
        public function editFiche(Request $request, $id){
            $fiche=$this->getDoctrine()->getRepository(Fiche::class);
            $fiche=$fiche->find($id);
        
            //message d'erruer au cas ou l'id n'existe pas
        if (!$fiche) {
            throw $this->createNotFoundException(
                "il n'ya pas de fiche avec cet id" . $id);
        
        }
                //affichage du formulaire
        $form=$this->createFormBuilder($fiche)
                ->add('nom',TextType::class)
                ->add('laCategorie',EntityType::class,[
                    'class'=>Categorie::class,
                    'choice_label'=>'nom',
                    'expanded'=>false,
                    'multiple'=>false,

                ])  

                ->getForm();
                $form->handleRequest($request);
                // récupération des donnés et modifcation
                if ($form->isSubmitted()) {
                    $em=$this->getDoctrine()->getManager();
                    $fiche=$form->getData();
                    $em->flush();
                //redirection vers la page d'accueil (juste temporaire)
                    return $this->redirectToRoute('home');
                    # code...
                }
            
                return $this->render('fiche/modifier.html.twig',array('form'=> $form->createView()));
            
            ;

    }
        

}

