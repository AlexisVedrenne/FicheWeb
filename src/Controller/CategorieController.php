<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategorieRepository;

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

    
    /**
     * @Route("/all",name="all")
     * Undocumented function
     *
     * @param CategorieRepository $repo
     * @return void
     */
    public function getAll(CategorieRepository $repo){
        $lesCats=$repo->findAll();

        return $this->render('categorie/allCategories.html.twig',['lesCategories'=>$lesCats]);
    }

  
    /**
     * @Route("/{id}",name="categorie_")
     * Undocumented function
     *
     * @param CategorieRepository $repo
     * @param [type] $id
     * @return void
     */
    public function getCat(CategorieRepository $repo,$id){
        $cat = $repo->find($id);

        return $this->render('categorie/categorie.html.twig',['cat'=>$cat]);
    }
}
