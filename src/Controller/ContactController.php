<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\MessageType;
use App\Entity\Message;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request)
    {
        $message_form = $this->createForm(MessageType::class);
        $message_form->handleRequest($request);

        

        $message_repo = $this->getDoctrine()->getRepository(Message::class);
        $messages = $message_repo->findAll();

        if ($message_form->isSubmitted()){
            if(empty($_POST['recaptcha-response'])){
                $this->addFlash('error', 'Un problème est subvenu, réessayer. ');
                $message_form = $this->createForm(MessageType::class);
            }else{
                // On prepare l'URL
                $url =  "https://www.google.com/recaptcha/api/siteverify?secret=6LcUVd0cAAAAADfn4D_nySyWXv3ISEzNRYm5Ram_&response={$_POST['recaptcha-response']}"; 

                $response = file_get_contents($url);

                if(empty($response) || is_null($response)){
                    $this->addFlash('error', 'Un problème est subvenu, réessayer. ');
                    $message_form = $this->createForm(MessageType::class);
                }else{
                    $data = json_decode($response);
                    if($data->success){
                        if($message_form->isValid()){
                            $message = $message_form->getData();
                            $entityManager = $this->getDoctrine()->getManager();
                            $message->setSendAt(new \DateTime('now'));
                            $message->setIsRead(false);
                            $entityManager->persist($message);
                            $entityManager->flush();
                            
                      
require_once('../vendor/autoload.php');

$client = new \GuzzleHttp\Client();

$response = $client->request('POST', 'https://api.sendinblue.com/v3/smtp/email', [
  'body' => '{"sender":{"name":"TS - Site","email":"no-reply@theosaez.com"},"to":[{"email":"' . $message->getEmail() . '", "name":"' . $message->getName() . '"}],"bcc":[{"email":"contact@theosaez.com", "name":"TS-Pro"}],  "htmlContent":"<h1>Merci de votre message !</h1><br><br>J\'ai bien reçu votre message, je vais faire mon possible pour y répondre au plus vite<br>Votre Message : <br>' . $message->getMessage() . '","subject":"[Ne pas répondre] Message envoyé à Théo SAEZ"}',
  'headers' => [
    'Accept' => 'application/json',
    'Content-Type' => 'application/json',
    'api-key' => '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',
  ],
]);

// echo $response->getBody();

                            $this->addFlash('success', 'Le message est envoyé ! ');

                            $message_form = $this->createForm(MessageType::class);
                        }
                    }else{
                        $this->addFlash('error', 'Un problème est subvenu, réessayer. ');
                        $message_form = $this->createForm(MessageType::class);
                    }
                }
            }
        }
        return $this->render('contact/index.html.twig', [
            'message_form' => $message_form->createView(),
        ]);
    }
}


