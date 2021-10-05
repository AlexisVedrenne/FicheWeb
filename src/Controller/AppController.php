<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Contenu;
use App\Entity\Media;
use App\Entity\Fiche;

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

        //Cette ligne dirige vers la fonction qui ensuite deconnecter l'utilisateur du site
        return $this->redirectToRoute('app_logout');
    }

    public static function codeGen($longueur){
        $number= "0123456789";
        return substr(str_shuffle(str_repeat($number, $longueur)), 0, $longueur);
    }


    public static function traitementCtn(Fiche $fiche,$request,int $nbContenue, int $nbMedia){
        $contenue=new Contenu();
        $contenue->setRubrique($request->get("rub-".$nbContenue));
        $contenue->setDescription($request->get("des-".$nbContenue));
        $contenue->setFiche($fiche);
        for($i=0;$i<$nbMedia;){
            $i++;
            $media=new Media();
            $media->setLien($request->get("lien-".$i."-".$nbContenue));
            $media->setType($request->get("type-".$i."-".$nbContenue));
            $contenue->addLesMedia($media);
        }

        return $contenue;
    }
}
