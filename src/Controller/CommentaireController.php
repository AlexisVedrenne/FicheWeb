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
use Symfony\Component\HttpFoundation\RedirectResponse;


class CommentaireController extends AbstractController
{



    /**
     * @Route("/commentaire/post",name="commentaire_post")
     */
    public function postCommentaire(Request $request,EntityManagerInterface $manager,FicheRepository $repo){
        $commentaire=new Commentaire();
        $fiche=$repo->find($request->request->get('ficheId'));
        $commentaire->setUser($this->getUser());
        $commentaire->setTexte($request->request->get('form')['message']);
        $commentaire->addFiche($fiche);
        $manager->persist($commentaire);
        $manager->flush();

        return new RedirectResponse('/fiche/'.$request->request->get('ficheId') );
    }

    public function AddCommentaire($ficheId) {
        $form = $this->createFormBuilder()
                ->setAction($this->generateUrl("commentaire_post"))
                ->add('message', TextType::class)
                ->add('Commenter',SubmitType::class)               
                ->getForm();
        return $this->render('commentaire/commentaire.html.twig',['form'=>$form->createView(),'ficheId'=>$ficheId]);
    }
}
