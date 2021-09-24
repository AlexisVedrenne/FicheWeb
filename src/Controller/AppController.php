<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


class AppController extends AbstractController
{


    /**
     * @route("/",name="home")
     */
    public function home(){

        return $this->render('app/index.html.twig');

    }

    /**
     * @route("/deconnexion",name="deconnexion")
     */
    public function deconnexion(EntityManagerInterface $manager){

        //Ces lignes permette de changer le status de en ligne à hors ligne
        $user=$this->getUser();
        $user->setStatutConnexion(false);
        $manager->persist($user);
        $manager->flush();

        return $this->redirectToRoute('app_logout');
    }
}
