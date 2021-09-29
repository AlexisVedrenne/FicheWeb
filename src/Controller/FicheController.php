<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FicheRepository;

class FicheController extends AbstractController
{
    /**
     * @Route("/fiche", name="fiche")
     */
    public function index(): Response
    {
        return $this->render('fiche/index.html.twig', [
            'controller_name' => 'FicheController',
        ]);
    }

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

