<?php

namespace App\Service;

use \Mailjet\Resources;
use \Mailjet\Client;
use App\Entity\User;

  // require 'vendor/autoload.php';
  
Class Mail{


  static private function getClient(){
    return new Client('0843d33c52ad141defeeff5a94eb0081','71bb0e7dddb6eec924f71afc00cad193',true,['version' => 'v3.1']);
  }

  static public function envoie(User $user,string $sujet,string $partieTexte,string $partieHtml){

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
            'Subject' => $sujet,
            'TextPart' => $partieTexte,
            'HTMLPart' => $partieHtml,
            'CustomID' => "AppGettingStartedTest"
          ]
        ]
      ];
      $response = Mail::getClient()->post(Resources::$Email, ['body' => $body]);
      return $response->success();
  }

  static public function bienvenue(User $user){
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
          'HTMLPart' => "<h1>Merci pour votre inscription " . $user->getPseudo()." !</h1>
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
}
?>
