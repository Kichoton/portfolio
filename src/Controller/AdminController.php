<?php

namespace App\Controller;

use App\Entity\GraphicCreation;
use App\Form\GraphicCreationType;
use App\Entity\WebCreation;
use App\Form\WebCreationType;
use App\Entity\Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Service\FileUploader;
use Symfony\Component\Routing\Annotation\Route;


class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function admin(): Response
    {
        $message_repo = $this->getDoctrine()->getRepository(Message::class);
        $messages = $message_repo->findAll();

        $webcrea_repo = $this->getDoctrine()->getRepository(WebCreation::class);
        $webcreas = $webcrea_repo->findAll();

        $graphiccrea_repo = $this->getDoctrine()->getRepository(GraphicCreation::class);
        $graphiccreas = $graphiccrea_repo->findAll();


        return $this->render('admin/index.html.twig', [
            "messages" => $messages,
            "webcreas" => $webcreas,
            "graphiccreas" => $graphiccreas
        ]);

        
    }

    /**
     * @Route("/admin/web_edit", name="admin_web_edit")
     */
    public function webAdmin(Request $request, FileUploader $fileUploader)
    {
        $webcrea_form = $this->createForm(WebCreationType::class);
        $webcrea_form->handleRequest($request);

        $webcrea_repo = $this->getDoctrine()->getRepository(WebCreation::class);
        $webcreas = $webcrea_repo->findAll();

        if ($webcrea_form->isSubmitted()){
            if($webcrea_form->isValid()){
                $webcrea = $webcrea_form->getData();

                $miniature_creaweb = $webcrea_form["miniature"]->getData();
                $miniature_creaweb_name = $fileUploader->upload($miniature_creaweb, "img/miniature_web ");

                $webcrea->setMiniature($miniature_creaweb_name);


                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($webcrea);
                $entityManager->flush();
                return $this->redirectToRoute("admin");
            }
        }
    
        return $this->render('admin/web_edit.html.twig', [
            "webcreas" => $webcreas,
            "webcrea_form" => $webcrea_form->createView()
        ]);

        
    }

    /**
     * @Route("/admin/graphic_edit", name="admin_graphic_edit")
     */
    public function graphicAdmin(Request $request)
    {
        $graphiccrea_form = $this->createForm(GraphicCreationType::class);
        $graphiccrea_form->handleRequest($request);

        $graphiccrea_repo = $this->getDoctrine()->getRepository(GraphicCreation::class);
        $graphiccreas = $graphiccrea_repo->findAll();

        if ($graphiccrea_form->isSubmitted()){
            if($graphiccrea_form->isValid()){
                $graphiccrea = $graphiccrea_form->getData();
                
               

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($graphiccrea);
                $entityManager->flush();
                return $this->redirectToRoute("admin");

            }
        }
    
        return $this->render('admin/graphic_edit.html.twig', [
            "graphiccreas" => $graphiccreas,
            "graphiccrea_form" => $graphiccrea_form->createView()
        ]);  
    }
    // Ajouter routes pour afficher les messages recus
}
