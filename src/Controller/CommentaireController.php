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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class CommentaireController extends AbstractController
{



    /**
     * @Route("/commentaire/post",name="commentaire_post")
     * @IsGranted("ROLE_USER")
     * @IsGranted("ROLE_ADMIN")
     * 
     * $request : C'est la variable qui va stocker toute la requête http qui a été effectuer
     * $manager : C'est la variable qui permet de gérer les entitées vers la base de donnée
     * $repo : C'est la variable qui permet de faire le lien avec la base pour Fiche
     * 
     *  @return Response Cette objet est la réponse qui est envoyer au navigateur (ex l'affichage)
     * 
     * Cette fonction permet de poster un nouveau commentaire sur une fiche
     */
    public function postCommentaire(Request $request,EntityManagerInterface $manager,FicheRepository $repo):Response{
        $commentaire=new Commentaire();
        $fiche=$repo->find($request->request->get('ficheId'));
        $commentaire->setUser($this->getUser());
        $commentaire->setTexte($request->request->get('form')['message']);
        $commentaire->setIsValid(false);
        $commentaire->setFiche($fiche);
        $manager->persist($commentaire);
        $manager->flush();

        return new RedirectResponse('/fiche/voir/'.$request->request->get('ficheId') );
    }

    /**
     * $ficheId : Cette variable représente l'id de la fiche lié au formulaire qui permet de commenter
     * 
     * Cette fonction générer le formulaire de commentaire en fonction de la fiche demander 
     */
    public function AddCommentaire($ficheId) {
        $form = $this->createFormBuilder()
                ->setAction($this->generateUrl("commentaire_post"))
                ->add('message', TextType::class)
                ->add('Commenter',SubmitType::class)               
                ->getForm();
        return $this->render('commentaire/commentaire.html.twig',['form'=>$form->createView(),'ficheId'=>$ficheId]);
    }

}
