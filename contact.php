<?php 
    require_once(__DIR__ . '/vendor/autoload.php');
    use \Mailjet\Resources;
    define('API_PUBLIC_KEY', '1f52c7016300146c2bb9e876766113a7');
    define('API_PRIVATE_KEY', 'fb6d85ac2dbebc757fb4064afb67c7ef');
    $mj = new \Mailjet\Client(API_PUBLIC_KEY, API_PRIVATE_KEY,true,['version' => 'v3.1']);


    if(!empty($_POST['surname']) && !empty($_POST['firstname']) && !empty($_POST['email']) && !empty($_POST['message'])){
        $surname = htmlspecialchars($_POST['surname']);
        $firstname = htmlspecialchars($_POST['firstname']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $body = [
                'Messages' => [
                  [
                    'From' => [
                      'Email' => "hugo.assal1@gmail.com",
                      'Name' => "Assal"
                    ],
                    'To' => [
                      [
                        'Email' => "hugo.assal1@gmail.com",
                        'Name' => "Assal"
                      ]
                    ],
                    'Subject' => "Greetings from Mailjet.",
                    'TextPart' => "$email, $message",
            ]
            ]
        ];
            $response = $mj->post(Resources::$Email, ['body' => $body]);
            $response->success();
            echo "Email envoyé avec succès !";
        }
        else{
            echo "Email non valide";
        }

    } else {
        header('Location: index.php');
        die();
    }