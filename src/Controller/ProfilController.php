<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\ProfilType;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface as Hasher;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function index(): Response
    {

        return $this->render('user/edit.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }

    /**
     * @Route("/compte", name="user_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     * 
     * $request ce qui va permettre de récuperer les données provenant du formulaire de modification
     * $user c'est pour récuperer les données d'user connecté
     * $form c'est pour créer le formulaire d'user
     * handlerequest : prise en charge du traitement des données du formulaire
     * $entityManager:qui nous permet de manipuler  l'entité user
     * 
     * Cette fonction permet de récuperer les données rentrés par l'utlisateur et aprés les modifier dans la base des données
     */
    public function edit(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(ProfilType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $user = $form->getData();
            $entityManager->flush();
            //return $this->redirectToRoute('');
        }
        return $this->render('user/edit.html.twig', array('form' => $form->createView()));;
    }
}
