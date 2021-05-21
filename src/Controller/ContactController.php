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
            if($message_form->isValid()){
                $message = $message_form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $message->setSendAt(new \DateTime('now'));
                $message->setIsRead(false);
                $entityManager->persist($message);
                $entityManager->flush();

                $this->addFlash('success', 'Le message est envoyé ! ');

                $message_form = $this->createForm(MessageType::class);
            }
        }
        return $this->render('contact/index.html.twig', [
            'message_form' => $message_form->createView(),
        ]);
    }
}


