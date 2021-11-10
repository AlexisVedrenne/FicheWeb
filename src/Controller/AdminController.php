<?php

namespace App\Controller;

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

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{


    /**
     * @Route("/acceuil",name="index")
     * @IsGranted("ROLE_ADMIN")
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
     */
    public function getAllDemandes(DemandeFicheRepository $repo){
        $lesDemandes= $repo->findAll();
        return $this->render('admin/toutesdemande.html.twig',['demandes'=>$lesDemandes]);

    }



    /**
     * @Route("/suppDemande/{id}",name="suppDemande")
     * @IsGranted("ROLE_ADMIN")
     */
    public function deleteDemande(int $id,DemandeFicheRepository $repo,EntityManagerInterface $manager){
        $demande=$repo->find($id);
        $manager->remove($demande);
        $manager->flush();
        return $this->redirectToRoute('admin_demandes');
    }


    /**
     * @Route("/commentaires",name="commentaires")
     * @IsGranted("ROLE_ADMIN")
     */
    public function getCommentaire(CommentaireRepository $repo){
        $lesCommantaires=$repo->getCommNonValid();
        return $this->render('admin/commValid.html.twig',['lesCommentaires'=>$lesCommantaires]);
    }


    /**
     * @Route("/suppCommentaire/{id}",name="suppCommentaire")
     * @IsGranted("ROLE_ADMIN")
     */
    public function deleteCommentaire(int $id,CommentaireRepository $repo,EntityManagerInterface $manager){
        $commentaire=$repo->find($id);
        $commentaire->setUser(null);
        $commentaire->setFiche(null);
        $manager->remove($commentaire);
        $manager->flush();
        return $this->redirectToRoute('admin_commentaires');
    }

    /**
     * @Route("/validCommentaire/{id}",name="validCommentaire")
     * @IsGranted("ROLE_ADMIN")
     */
    public function validCommentaire(int $id,CommentaireRepository $repo,EntityManagerInterface $manager){
        $commentaire=$repo->find($id);
        $commentaire->setIsValid(true);
        $manager->persist($commentaire);
        $manager->flush();
        return $this->redirectToRoute('admin_commentaires');
    }

    /**
     * @Route("/users",name="users")
     * @IsGranted("ROLE_ADMIN")
     */
    public function getAllUser(UserRepository $repo){
        $users=$repo->findAll();
        return $this->render('admin/user.html.twig',['users'=>$users]);
    }

    /**
     * @Route("/modifUser")
     */
    public function modifUser(UserRepository $repo,EntityManagerInterface $manager,Request $request){
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
     */
    public function getAllFiche(FicheRepository $repo){
        $fiches=$repo->findAll();
        return $this->render('admin/fiche.html.twig',['fiches'=>$fiches]);
    }
}
