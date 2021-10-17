<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\DemandeFicheRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{


    /**
     * @Route("/acceuil",name="index")
     */
    public function index(DemandeFicheRepository $repo): Response
    {
        $last=$repo->getLastDemande();
        return $this->render('admin/index.html.twig',['last'=>$last]);
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
        $id=intval($id);
        $demande=$repo->find($id);
        $manager->remove($demande);
        $manager->flush();
        return $this->redirectToRoute('admin_demandes');
    }

}
