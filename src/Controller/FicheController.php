<?php

namespace App\Controller;

use DoctrineExtensions\Query\Mysql\Rand;
use App\Entity\DemandeFiche;
use App\Repository\FicheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\FicheType;
use App\Entity\Fiche;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Categorie;
use App\Repository\CommentaireRepository;
use App\Form\DemandeFicheType;
use App\Service\Mail;
use App\Repository\DemandeFicheRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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
     * @Route("/voir/{id}",name="voir")
     * Undocumented function
     *
     * @param FicheRepository $repo
     * @param [type] $id
     * @return void
     */
    public function getFiche(FicheRepository $repo, int $id, CommentaireRepository $cmtRepo)
    {
        $fiche = $repo->find($id);
        $lesCommenaitres = $fiche->getCommentaires();
        return $this->render('fiche/fiche.html.twig', ['fiche' => $fiche, 'lesCommentaires' => $lesCommenaitres]);
    }

    /**
     * @Route("/ajout/{id}",name="add")
     * @Route("/ajout")
     * @IsGranted("ROLE_ADMIN")
     */
    public function addFiche(int $id=null, DemandeFicheRepository $repo, Request $request, EntityManagerInterface $manager)
    {   
        if($id!=null){
            $demande = $repo->find($id);
        }
        $fiche = new Fiche();
        $form = $this->createForm(FicheType::class, $fiche);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $nbContenue = intval($request->request->get('nbContenue'));
            for ($i = 0; $i < $nbContenue;) {
                $i++;
                $fiche->addContenu(AppController::traitementCtn($fiche, $request->request, $i, intVal($request->request->get('nbMedia-' . $i))));
            }

            $manager->persist($fiche);
            if($id!=null){
                $manager->remove($demande);
                Mail::demandeFicheFermer($demande->getUser(),$demande->getObjet(),$demande->getMessage(),$demande->getCategorie()->getNom(),$fiche->getId());
            }            
            $manager->flush();
            return $this->redirectToRoute('admin_demandes');
        }

        return $this->render('fiche/ajouter.html.twig', ['form' => $form->createView(),'demande'=>$id!=null?$demande:'']);
    }



    /**
     * @Route("/edit/{id}", name="edit")
     * c'est une fonction qui permet de modifier une fiche (nom/catégorie)
     */
    public function editFiche(Request $request, $id)
    {
        $fiche = $this->getDoctrine()->getRepository(Fiche::class);
        $fiche = $fiche->find($id);

        //message d'erruer au cas ou l'id n'existe pas
        if (!$fiche) {
            throw $this->createNotFoundException(
                "il n'ya pas de fiche avec l'id " . $id
            );
        }
        //affichage du formulaire
        $form = $this->createFormBuilder($fiche)
            ->add('nom', TextType::class)
            ->add('laCategorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'nom',
                'expanded' => false,
                'multiple' => false,

            ])

            ->getForm();
        $form->handleRequest($request);
        // récupération des donnés et modifcation
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $fiche = $form->getData();
            $em->flush();
            //redirection vers la page d'accueil (juste temporaire)
            return $this->redirectToRoute('home');
            # code...
        }

        return $this->render('fiche/modifier.html.twig', array('form' => $form->createView()));;
    }


    /**
     * @Route("/demande",name="demande")
     */
    public function demandeFiche(Request $request, EntityManagerInterface $manager)
    {
        $demande = new DemandeFiche();
        $form = $this->createForm(DemandeFicheType::class, $demande);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $demande->setUser($this->getUser());
            $manager->persist($demande);
            $manager->flush();
            Mail::demandeFiche($demande->getUser(), $demande->getObjet(), $demande->getMessage(), $demande->getCategorie()->getNom());
            return $this->redirectToRoute('home');
        }

        return $this->render('fiche/demandeFiche.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/tous",name="tous")
     */
    public function getAll(FicheRepository $repo)
    {
        $lesFiches = $repo->findAll();

        return $this->render('fiche/allFiches.html.twig', ['lesFiches' => $lesFiches]);
    }


    
}
