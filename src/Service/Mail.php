<?php

namespace App\Service;

use \Mailjet\Resources;
use \Mailjet\Client;
use App\Entity\User;

  // require 'vendor/autoload.php';
  
Class Mail{

  static public function envoie(User $user,string $sujet,string $partieTexte,string $partieHtml){
      $mj = new Client('0843d33c52ad141defeeff5a94eb0081','71bb0e7dddb6eec924f71afc00cad193',true,['version' => 'v3.1']);

      $body = [
        'Messages' => [
        [
            'From' => [
              'Email' => "alexisvedrenne482@gmail.com",
              'Name' => "Alexis"
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
      $response = $mj->post(Resources::$Email, ['body' => $body]);
      $response->success() && var_dump($response->getData());
  }
}
?>
