<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\DemandeFiche;
use App\Repository\CommentaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\DemandeFicheRepository;
use App\Repository\FicheRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Fiche;

/**
 * @Route("/admin", name="admin_")
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{


    /**
     * @Route("/acceuil",name="index")
     * @IsGranted("ROLE_ADMIN")
     * 
     * $repo : C'est la variable qui permet l'accès au données de la classe DemandeFiche
     * $ctRpo : C'est la variable qui permet l'accès au données de la classe Commentaire
     * $uRepo : C'est la variable qui permet l'accès au données de la classe USer
     * @return Response Cette objet est la réponse qui est envoyer au navigateur (ex l'affichage)
     * 
     * Cette fonction permet d'afficher le menu administrateur, qui permet à un administrateur de gérer plusieurs fonction
     */
    public function index(DemandeFicheRepository $repo,CommentaireRepository $ctRepo,UserRepository $uRepo): Response
    {
        $last=$repo->getLastDemande();
        $nbComm=$ctRepo->getNbComm();
        $nbuser=$uRepo->getNbUser();
        return $this->render('admin/index.html.twig',['last'=>$last,'nb'=>$nbComm,'nbU'=>$nbuser]);
    }


    /**
     * @Route("/demandes",name="demandes")
     * @IsGranted("ROLE_ADMIN")
     * 
     * $repo : C'est la variable qui permet l'accès au données de la classe DemandeFiche
     * @return Response Cette objet est la réponse qui est envoyer au navigateur (ex l'affichage)
     * 
     * Cette fonction permet de gérer les demandes de fiche, de les accepter et donc de créer la fiche
     * ou de les supprimer
     */
    public function getAllDemandes(DemandeFicheRepository $repo):Response {
        $lesDemandes= $repo->findAll();
        return $this->render('admin/toutesdemande.html.twig',['demandes'=>$lesDemandes]);

    }



    /**
     * @Route("/suppDemande/{id}",name="suppDemande")
     * @IsGranted("ROLE_ADMIN")
     * 
     * $demande : Cette variable représentera la demande que l'on veut supprimer
     * $manager : C'est la variable qui permet de gérer les entitées vers la base de donnée
     * 
     * @return Response Cette objet est la réponse qui est envoyer au navigateur (ex l'affichage)
     * 
     * Cette fonction permet de supprimer une demande de fiche
     */
    public function deleteDemande(DemandeFiche $demande,EntityManagerInterface $manager):Response{
        $manager->remove($demande);
        $manager->flush();
        return $this->redirectToRoute('admin_demandes');
    }


    /**
     * @Route("/commentaires",name="commentaires")
     * @IsGranted("ROLE_ADMIN")
     * 
     * $repo : C'est la variable qui permet l'accès au données de la classe Commentaire
     * 
     * @return Response Cette objet est la réponse qui est envoyer au navigateur (ex l'affichage)
     * 
     * Cette fonction permet de récuperer tous les commentaires qui n'on pas été valider par un administrateur
     */
    public function getCommentaire(CommentaireRepository $repo):Response{
        $lesCommantaires=$repo->getCommNonValid();
        return $this->render('admin/commValid.html.twig',['lesCommentaires'=>$lesCommantaires]);
    }


    /**
     * @Route("/suppCommentaire/{id}",name="suppCommentaire")
     * @IsGranted("ROLE_ADMIN")
     * 
     * $commentaire : Cette variable représentera le commentaire que l'on veut supprimer
     * $manager : C'est la variable qui permet de gérer les entitées vers la base de donnée
     * 
     * @return Response Cette objet est la réponse qui est envoyer au navigateur (ex l'affichage)
     * 
     * Cette fonction permet de supprimer un commentaire que l'on ne veut pas valider
     */
    public function deleteCommentaire(Commentaire $commentaire, EntityManagerInterface $manager):Response{
        $commentaire->setUser(null);
        $commentaire->setFiche(null);
        $manager->remove($commentaire);
        $manager->flush();
        return $this->redirectToRoute('admin_commentaires');
    }

    /**
     * @Route("/validCommentaire/{id}",name="validCommentaire")
     * @IsGranted("ROLE_ADMIN")
     * 
     * $commentaire : Cette variable représentera le commentaire que l'on veut valider
     * $manager : C'est la variable qui permet de gérer les entitées vers la base de donnée
     * 
     * @return Response Cette objet est la réponse qui est envoyer au navigateur (ex l'affichage)
     * 
     * Cette fonction permet de valider un commentaire qui a été poster sur une fiche par un utilisateur
     */
    public function validCommentaire(Commentaire $commentaire,EntityManagerInterface $manager):Response{
        $commentaire->setIsValid(true);
        $manager->persist($commentaire);
        $manager->flush();
        return $this->redirectToRoute('admin_commentaires');
    }

    /**
     * @Route("/users",name="users")
     * @IsGranted("ROLE_ADMIN")
     * 
     * $repo : C'est la variable qui permet l'accès au données de la classe User
     * 
     * @return Response Cette objet est la réponse qui est envoyer au navigateur (ex l'affichage)
     * 
     * Cette fonction permet de gérer tous les utulisateurs du sites
     */
    public function getAllUser(UserRepository $repo):Response{
        $users=$repo->findAll();
        return $this->render('admin/user.html.twig',['users'=>$users]);
    }

    /**
     * @Route("/modifUser")
     * @IsGranted("ROLE_ADMIN")
     * 
     * $repo : C'est la variable qui permet l'accès au données de la classe User
     * $manager : C'est la variable qui permet de gérer les entitées vers la base de donnée
     * $request : C'est la variable qui va stocker toute la requête http qui a été effectuer
     * 
     * @return Response Cette objet est la réponse qui est envoyer au navigateur (ex l'affichage)
     * 
     * Cette fonction permet de modifier les données d'un utilisateur
     */
    public function modifUser(UserRepository $repo,EntityManagerInterface $manager,Request $request):Response{
        $user=$repo->find($request->request->get('idUser'));
        $user->setPseudo($request->request->get('inPseudo-'.$user->getId()));
        $user->setEmail($request->request->get('inEmail-'.$user->getId()));
        $user->setRoles(['ROLE'=>$request->request->get('slRole-'.$user->getId())]);
        $manager->persist($user);
        $manager->flush();
        return $this->redirectToRoute('admin_users');
    }

    /**
     * @Route("/fiches",name="fiches")
     * @IsGranted("ROLE_ADMIN")
     * 
     * $repo : C'est la variable qui permet l'accès au données de la classe Fiche
     * 
     * @return Response Cette objet est la réponse qui est envoyer au navigateur (ex l'affichage)
     * 
     * Cette fontion permet de récuperer toute les fiches
     */
    public function getAllFiche(FicheRepository $repo):Response{
        $fiches=$repo->findAll();
        return $this->render('admin/fiche.html.twig',['fiches'=>$fiches]);
    }

    /**
     *@Route("/del/fiche/{id}")
     * @IsGranted("ROLE_ADMIN")
     * 
     * $fiche : C'est la variable qui va représenter la fiche que l'on veut supprimer
     * 
     * @return Response Cette objet est la réponse qui est envoyer au navigateur (ex l'affichage)
     * 
     * Cette fonction permet de supprimer une fiche
     */
    public function deleteFiche(Fiche $fiche,EntityManagerInterface $manager):Response{
        $manager->remove($fiche);
        $manager->flush();
        return $this->redirectToRoute('admin_fiches');
    }
}
