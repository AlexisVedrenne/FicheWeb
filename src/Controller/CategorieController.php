<?php

namespace App\Controller;

use App\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\CategorieType;

/**
* @Route("/categorie", name="categorie_")
*/
class CategorieController extends AbstractController
{

    public function index(): Response
    {
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }

    
    // /**
    //  * @Route("/all",name="all")
    //  * Undocumented function
    //  *
    //  * @param CategorieRepository $repo
    //  * @return void
    //  */
    // public function getAll(CategorieRepository $repo){
    //     $lesCats=$repo->findAll();

    //     return $this->render('categorie/allCategories.html.twig',['lesCategories'=>$lesCats]);
    // }

  
    // /**
    //  * @Route("/cherche/{id}",name="categorie_")
    //  * Undocumented function
    //  *
    //  * @param CategorieRepository $repo
    //  * @param [type] $id
    //  * @return void
    //  */
    // public function getCat(CategorieRepository $repo,$id){
    //     $cat = $repo->find($id);

    //     return $this->render('categorie/categorie.html.twig',['cat'=>$cat]);
    // }


    // /**
    //  * @Route("/ajout",name="all")
    //  * Undocumented function
    //  *
    //  * @param Request $request
    //  * @param EntityManagerInterface $manager
    //  * @return void
    //  */
    // public function creeCategorie(Request $request,EntityManagerInterface $manager){
    //     $categorie= new Categorie();
    //     $form=$this->createForm(CategorieType::class,$categorie);
    //     $form->handleRequest($request);
    //     if($form->isSubmitted()&&$form->isValid()){
    //         $manager->persist($categorie);
    //         $manager->flush();
    //         return $this->redirectToRoute('categorie_all');
    //     }

    //     return $this->render('categorie/ajouter.html.twig',['form'=>$form->createView()]);
    // }
}
