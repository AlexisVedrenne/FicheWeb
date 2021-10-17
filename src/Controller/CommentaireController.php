<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Commentaire;
use App\Repository\FicheRepository;


class CommentaireController extends AbstractController
{
    /**
     * @Route("/commentaire", name="commentaire")
     */
    public function index(): Response
    {
        return $this->render('commentaire/index.html.twig', [
            'controller_name' => 'CommentaireController',
        ]);
    }


    /**
     * @Route("/commentaire",name="commentaire_post")
     */
    public function postCommentaire(Request $request,EntityManagerInterface $manager,FicheRepository $repo){
        $commentaire=new Commentaire();
        $fiche=$repo->find($request->request->get('ficheId'));
        $commentaire->setUser($this->getUser());
        $commentaire->setTexte($request->request->get('message'));
        $commentaire->addFiche($fiche);
        $manager->persist($commentaire);
        $manager->flush();

        $this->generateUrl('fiche_', ['id'=>$request->request->get('ficheId')]);
    }

    public function Commentaire($ficheId) {
        $form = $this->createFormBuilder()
                ->setAction($this->generateUrl("commentaire_post"))
                ->add('message', TextType::class)
                ->add('post',SubmitType::class)               
                ->getForm();
        return $this->render('commentaire/commentaire.html.twig',['form'=>$form->createView(),'ficheId'=>$ficheId]);
    }
}
