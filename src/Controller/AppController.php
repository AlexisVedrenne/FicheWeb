<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Contenu;
use App\Entity\Fiche;
use App\Entity\Media;
use App\Repository\FicheRepository;


class AppController extends AbstractController
{


    /**
     * @route("/",name="home")
     * 
     * @return Response Cette objet est la réponse qui est envoyer au navigateur (ex l'affichage)
     * 
     * Cette fonction permet l'affoche de notre page d'aceuil
     */
    public function home(FicheRepository $repo):Response{

        $lesFiches = $repo->affichage_alea();

        return $this->render('app/index.html.twig', ['lesFiches' => $lesFiches]);
    }

    /**
     * @route("/deconnexion",name="deconnexion")
     * 
     * $manager : C'est la variable qui permet de gérer les entitées vers la base de donnée
     * 
     * @return Response Cette objet est la réponse qui est envoyer au navigateur (ex l'affichage)
     * 
     * Cette fonction permet de nous deconnecter du site et elle met l'utilisateur en question 
     * en hors ligne en base de donnée
     */
    public function deconnexion(EntityManagerInterface $manager):Response{

        //Ces lignes permette de changer le status de en ligne à hors ligne
        $user = $this->getUser();
        $user->setStatutConnexion(false);
        $manager->persist($user);
        $manager->flush();

        //Cette ligne dirige vers la fonction qui ensuite deconnecter l'utilisateur du site
        return $this->redirectToRoute('app_logout');
    }

    /**
     * $longueur : Cette variable représente la longeur du code que l'on veut générer
     * 
     * Cette fonction permet
     */
    public static function codeGen($longueur){
        $number= "0123456789";
        return substr(str_shuffle(str_repeat($number, $longueur)), 0, $longueur);
    }


    public static function traitementCtn(Fiche $fiche, $request, int $nbContenue, int $nbMedia)
    {
        $contenue = new Contenu();
        $contenue->setRubrique($request->get("rub-" . $nbContenue));
        $contenue->setDescription($request->get("des-" . $nbContenue));
        $contenue->setFiche($fiche);
        for ($i = 0; $i < $nbMedia;) {
            $i++;
            $media = new Media();
            $media->setLien($request->get("lien-" . $i . "-" . $nbContenue));
            $media->setType($request->get("type-" . $i . "-" . $nbContenue));
            $contenue->addLesMedia($media);
        }

        return $contenue;
    }

    public static function modifCtn($request,$fiche){
        foreach ($fiche->getContenus() as $contenu) {
            $contenu->setRubrique($request->get("rb-".$contenu->getId()));
            $contenu->setDescription($request->get("des-".$contenu->getId()));
                foreach ($contenu->getLesMedias() as $media) {
                $media->setType($request->get("sl-".$contenu->getId()."-".$media->getId()));
                $media->setLien($request->get("lien-".$contenu->getId()."-".$media->getId()));
            }
        }

    }
}
