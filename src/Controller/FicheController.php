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

<<<<<<< HEAD
     /**
     * @Route("/all",name="all")
     * Undocumented function
     *
     * @param FicheRepository $repo
     * @return void
     */

    public function getAll(FicheRepository $repo){
        $lesFiches=$repo->findAll();

        return $this->render('fiche/allFiches.html.twig',['lesFiches'=>$lesFiches]);
    }

}

=======
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
}
>>>>>>> dev
