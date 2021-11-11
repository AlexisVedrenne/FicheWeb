<?php

namespace App\Controller;

use App\Repository\FicheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Repository\NavireRepository;
use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchController extends AbstractController
{

    public function index(): Response
    {
        return $this->render('fiche/rechercher.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }

    /**
     * @Route("search/handlesearch", name="search_handlesearch")
     *
     * $mot: c'est la valeur entré par l'utlisateur dans la barre du recherche
     * $request:ce qui va permettre de récuperer les données provenant du formulaire de recherche
     * $repo : C'est la variable qui permet l'accès au données de la classe Fiche
     */

    public function handleSearch(Request $request, FicheRepository $repo)
    {
        $mot = $request->query->get("mot");
        return $this->render('fiche/allFiches.html.twig', [
            'lesFiches' => $repo->recherche($mot),
            'mot' => $mot
        ]);
    }
}
