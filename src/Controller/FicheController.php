<?php

namespace App\Controller;

use App\Entity\DemandeFiche;
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
use App\Form\DemandeFicheType;
use App\Service\Mail;
use App\Repository\DemandeFicheRepository;
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
     * @Route("/ajout/{id}",name="add")
     */
    public function addFiche(int $id,DemandeFicheRepository $repo,Request $request, EntityManagerInterface $manager )
    {
        $demande=$repo->find($id);
        $fiche= new Fiche();
        $form=$this->createForm(FicheType::class,$fiche);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $nbContenue=intval($request->request->get('nbContenue'));
            for($i=0;$i<$nbContenue;){
                $i++;
               $fiche->addContenu(AppController::traitementCtn($fiche,$request->request,$i,intVal($request->request->get('nbMedia-'.$i))));
            }

            $manager->persist($fiche);
            $manager->remove($demande);
            $manager->flush();
            return $this->redirectToRoute('admin_demandes');
        }
        return $this->render('fiche/ajouter.html.twig',['form'=>$form->createView()]);

    }

    /**
     * @Route("/demande",name="demande")
     */
    public function demandeFiche(Request $request,EntityManagerInterface $manager){
        $demande = new DemandeFiche();
        $form=$this->createForm(DemandeFicheType::class,$demande);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $demande->setUser($this->getUser());
            $manager->persist($demande);
            $manager->flush();
            Mail::demandeFiche($demande->getUser(),$demande->getObjet(),$demande->getMessage(),$demande->getCategorie()->getNom());
            return $this->redirectToRoute('home');
        }

        return $this->render('fiche/demandeFiche.html.twig',['form'=>$form->createView()]);

    }
}
