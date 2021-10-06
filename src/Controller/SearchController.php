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

class SearchController extends AbstractController {

    public function index(): Response {
        return $this->render('fiche/rechercher.html.twig', [
                    'controller_name' => 'SearchController',
        ]);
    }

    /**
     * @Route("search/handlesearch", name="search_handlesearch")
     *
     */

     public function handleSearch(Request $request,FicheRepository $repo){
         $valeurs=$request->request->get('form')['nom'];
         $repo->findBy(array('nom'=>$valeurs));
         
         return $this->redirectToRoute('fiche_all');
         
        

     }

     /**
     * @Route("/search", name="search")
     */

     public function searchBar()
     {
         $form=$this->createFormBuilder()
         ->setAction($this->generateUrl("search_handlesearch"))
         ->add('nom')
         ->add('Rechercher',SubmitType::class)  
         ->getForm();
        

        
        
         
         return $this->render('fiche/rechercher.html.twig', ["form"=>$form->createView()]);
     }

}
