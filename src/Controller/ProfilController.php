<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface as Hasher;


class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function index(): Response
    {

        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user, int $id): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        $user = $this->getDoctrine()->getRepository(User::class);
        $user = $user->find($id);
        if ($form->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $user = $form->getData();
            $entityManager->flush();
            return $this->redirectToRoute('profil');
        }
        return $this->render('user/edit.html.twig', array('form' => $form->createView()));;
    }
}
