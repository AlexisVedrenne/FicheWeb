<?php

namespace App\Service;

use \Mailjet\Resources;
use \Mailjet\Client;
use App\Entity\User;

// require 'vendor/autoload.php';

class Mail
{


  static private function getClient()
  {
    return new Client('0843d33c52ad141defeeff5a94eb0081', '71bb0e7dddb6eec924f71afc00cad193', true, ['version' => 'v3.1']);
  }

  static public function envoie(string $mail, string $nom, string $tel, string $objet, string $msg)
  {

    $body = [
      'Messages' => [
        [
          'From' => [
            'Email' => "service@ficheweb.fr",
            'Name' => "Service Fiche Web"
          ],
          'To' => [
            [
              'Email' => "service@ficheweb.fr",
              'Name' => "Service Fiche Web"
            ]
          ],
          'Subject' => "Nouveau message",
          'TextPart' => "",

          'HTMLPart' => "<h1>Bonjour  vous venez de recevoir un nouveau message de la part de" . $nom . "</h1>
          <h3>Ses données personelles</h3>
          <h5>Email: " . $mail . " </h5>
          <h5>Tel: " . $tel . "</h5>
          <h5>Nom Complet:" . $nom . " </h5>
          <h3>Le message</h3>
          <h5>Objet: " . $objet . " </h5>
          <p>Le message: " . $msg . " </p>

          <h6>Veuillez ne pas répondre à ce mail générer automatiquement</h6>",
          'CustomID' => "AppGettingStartedTest",

        ]
      ]
    ];
    $response = Mail::getClient()->post(Resources::$Email, ['body' => $body]);
    return $response->success();
  }

  static public function bienvenue(User $user)
  {
    $body = [
      'Messages' => [
        [
          'From' => [
            'Email' => "service@ficheweb.fr",
            'Name' => "Service Fiche Web"
          ],
          'To' => [
            [
              'Email' => $user->getEmail(),
              'Name' => $user->getPseudo()
            ]
          ],
          'Subject' => "Bienvenue sur notre application !",
          'TextPart' => "",
          'HTMLPart' => "<h1>Merci pour votre inscription " . $user->getPseudo() . " !</h1>
          <p>Si vous recevez cette email c'est que votre compte à parfaitement été créer sur notre platforme.<br> Nous vous invitons à vous connecter pour pouvoir acceder à plus de contenue sur notre site.
          En vous connectant <a href='http://local.ficheweb/connexion'>ici</a>
          </p>
          <h4>Merci à vous, l'équipe FicheWeb</h4>
          <h6>Veuillez ne pas répondre à ce mail générer automatiquement</h6>",
          'CustomID' => "AppGettingStartedTest"
        ]
      ]
    ];
    $response = Mail::getClient()->post(Resources::$Email, ['body' => $body]);
    return $response->success();
  }

  static public function mdpOublier(string $mail, int $code)
  {
    $body = [
      'Messages' => [
        [
          'From' => [
            'Email' => "service@ficheweb.fr",
            'Name' => "Service Fiche Web"
          ],
          'To' => [
            [
              'Email' => $mail,
              'Name' => $mail
            ]
          ],
          'Subject' => "[FicheWeb Suppot] Mot de passe oublier",
          'TextPart' => "Support",
          'HTMLPart' => "<h1>Demande de nouveau mot de passe</h1>
          <p>Si vous n'etes pas à l'origne de cette demande ignorer ce mail.<br> Voici votre code générer automatiquement<br>
            <h1>" . $code . "</h1>
          </p>
          <h4>L'équipe FicheWeb</h4>
          <h6>Veuillez ne pas répondre à ce mail générer automatiquement</h6>",
          'CustomID' => "AppGettingStartedTest"
        ]
      ]
    ];
    $response = Mail::getClient()->post(Resources::$Email, ['body' => $body]);
    return $response->success();
  }

  static public function demandeFiche(User $user, string $objet, string $message, string $categorie)
  {
    $body = [
      'Messages' => [
        [
          'From' => [
            'Email' => "service@ficheweb.fr",
            'Name' => "Service Fiche Web"
          ],
          'To' => [
            [
              'Email' => $user->getEmail(),
              'Name' => $user->getPseudo()
            ]
          ],
          'Subject' => "[FicheWeb Suppot] Demande de nouvelle fiche : " . $objet,
          'TextPart' => "Support",
          'HTMLPart' => "<h1>Demande de nouvelle fiche</h1>
          <p>Une fiche de catégorie :<h5>" . $categorie . "</h5><br>
            La demmande est :" . $message . "
          </p>
          <h4>L'équipe FicheWeb</h4>
          <h6>Veuillez ne pas répondre à ce mail générer automatiquement</h6>",
          'CustomID' => "AppGettingStartedTest"
        ]
      ]
    ];
    $response = Mail::getClient()->post(Resources::$Email, ['body' => $body]);
    return $response->success();
  }

  static public function demandeFicheFermer(User $user, string $objet, string $message, string $categorie, $id)
  {
    $body = [
      'Messages' => [
        [
          'From' => [
            'Email' => "service@ficheweb.fr",
            'Name' => "Service Fiche Web"
          ],
          'To' => [
            [
              'Email' => $user->getEmail(),
              'Name' => $user->getPseudo()
            ]
          ],
          'Subject' => "[FicheWeb Suppot] Information sur la demande de fiche : " . $objet,
          'TextPart' => "Support",
          'HTMLPart' => "<h1>Information sur la demande</h1>
          <p>Une fiche de catégorie :<h5>" . $categorie . "</h5><br>
            La demmande était :" . $message . "
            Nous vous confirmons que votre demande a été prise en compte et que la fiche a bien été créer.
            Elle sera disponible au lien suivant http://local.ficheweb/fiche/voir/" . $id .
            "</p>
          <h4>L'équipe FicheWeb</h4>
          <h6>Veuillez ne pas répondre à ce mail générer automatiquement</h6>",
          'CustomID' => "AppGettingStartedTest"
        ]
      ]
    ];
    $response = Mail::getClient()->post(Resources::$Email, ['body' => $body]);
    return $response->success();
  }
}
