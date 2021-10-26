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

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{


    /**
     * @Route("/acceuil",name="index")
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
     */
    public function getAllDemandes(DemandeFicheRepository $repo){
        $lesDemandes= $repo->findAll();
        return $this->render('admin/toutesdemande.html.twig',['demandes'=>$lesDemandes]);

    }



    /**
     * @Route("/suppDemande/{id}",name="suppDemande")
     */
    public function deleteDemande(int $id,DemandeFicheRepository $repo,EntityManagerInterface $manager){
        $demande=$repo->find($id);
        $manager->remove($demande);
        $manager->flush();
        return $this->redirectToRoute('admin_demandes');
    }


    /**
     * @Route("/commentaires",name="commentaires")
     */
    public function getCommentaire(CommentaireRepository $repo){
        $lesCommantaires=$repo->getCommNonValid();
        return $this->render('admin/commValid.html.twig',['lesCommentaires'=>$lesCommantaires]);
    }


    /**
     * @Route("/suppCommentaire/{id}",name="suppCommentaire")
     */
    public function deleteCommentaire(int $id,CommentaireRepository $repo,EntityManagerInterface $manager,FicheRepository $fRepo){
        $commentaire=$repo->find($id);
        $commentaire->setUser(null);
        $commentaire->setFiche(null);
        $manager->remove($commentaire);
        $manager->flush();
        return $this->redirectToRoute('admin_commentaires');
    }

    /**
     * @Route("/validCommentaire/{id}",name="validCommentaire")
     */
    public function validCommentaire(int $id,CommentaireRepository $repo,EntityManagerInterface $manager){
        $commentaire=$repo->find($id);
        $commentaire->setIsValid(true);
        $manager->persist($commentaire);
        $manager->flush();
        return $this->redirectToRoute('admin_commentaires');
    }

}
