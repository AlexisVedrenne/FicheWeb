<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FicheRepository;
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
     * @Route("/{id}", name="uneFiche")
     * Undocumented function
     *
     * @param FicheRepository $repo
     * @param [type] $id
     * @return void
     */

    public function getFiche(FicheRepository $repo, $id){
        $fiche = $repo->find($id);

        return $this->render('fiche/fiche.html.twig',['fiche'=>$fiche]);
    }

    
}
