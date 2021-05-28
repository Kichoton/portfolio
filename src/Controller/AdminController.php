<?php

namespace App\Controller;

use App\Entity\GraphicCreation;
use App\Form\GraphicCreationType;
use App\Entity\WebCreation;
use App\Form\WebCreationType;
use App\Entity\Message;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
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
     * @Route("/admin/web_create_", name="admin_web_create_")
     * @Route("/admin/{id}/web_edit_", name="admin_web_edit_")
     */
    /**public function webAdmin($id = null, Request $request, FileUploader $fileUploader)
    {
        $web_form = $this->createForm(WebCreationType::class);
        $web_form->handleRequest($request);

        $web_repo = $this->getDoctrine()->getRepository(WebCreation::class);
        $webs = $web_repo->findAll();
        $entityManager = $this->getDoctrine()->getManager();

        if($id){
            
            $web_edit = $web_repo->Find($id);
            $web_form->get('name')->setData($web_edit->getName());
            $web_form->get('client')->setData($web_edit->getClient());
            $web_form->get('categorie')->setData($web_edit->getCategorie());
            $web_form->get('description')->setData($web_edit->getDescription());
            $web_form->get('url')->setData($web_edit->getUrl());
        }

        if ($web_form->isSubmitted()){
            if($web_form->isValid()){
                if(!$id){
                    $web = $web_form->getData();
                    $miniature_web = $web_form["miniature"]->getData();
                    $miniature_web_name = $fileUploader->upload($miniature_web, "img/miniature_web");
                    $web->setMiniature($miniature_web_name);
                }

                $entityManager->persist($web);
                $entityManager->flush();
                return $this->redirectToRoute("admin");
            }
        }
    
        return $this->render('admin/web_form.html.twig', [
            "webcreas" => $webs,
            "webcrea_form" => $web_form->createView()
        ]); 
    }
 */
    
    /**
     * @Route("/admin/web_create", name="admin_web_create")
     * @Route("/admin/{id}/web_edit", name="admin_web_edit")
     */

    public function webAdmin(WebCreation $web = null, Request $request, FileUploader $fileUploader)
    {
        $em = $this->getDoctrine()->getManager();

        $web_repo = $this->getDoctrine()->getRepository(WebCreation::class);
        $webs = $web_repo->findAll();

        if(!$web){
            $web = New WebCreation();
        }

        $web_form = $this->createFormBuilder($web)
                         ->add('name')
                         ->add('client')
                         ->add('categorie', ChoiceType::class, [
                            'choices'=> [
                                'Site web' => 'site web',
                                'Application Mobile' => 'application mobile',
                                'Programme' => 'programme'
                            ]
                        ])
                         ->add('miniature', FileType::class, [
                            'label' => 'Miniature (Jpg/Jpeg file)',
                            'mapped' => false,
                            "required" => false,
                            "constraints" => [
                                new File([
                                    'maxSize' => '1G',
                                    'mimeTypes' => [
                                        'image/jpeg',
                                        'image/png',
                                    ],
                                    'mimeTypesMessage' => 'Please send Jpeg or PNG file',
                                ])
                            ],
                        ])
                         ->add('description',CKEditorType::class, array(
                            'config_name' => 'my_config'
                         ))
                         ->add('url')
                         ->add('save', SubmitType::class,[
                            "label"=>'Envoyer',
                            "attr"=>[
                                'class'=>'button'
                            ]
                        ])
                         ->getForm();
            
        $web_form->handleRequest($request);
        
        if($web_form->isSubmitted() && $web_form->isValid()){
            if(!$web->getId()){
                $web->setCreatedAt (new \DateTime('now'));
                var_dump($web_form['miniature']);
                var_dump($web->getMiniature());
                die;
                $miniature_web = $web_form["miniature"]->getData();
                $miniature_web_name = $fileUploader->upload($miniature_web, "img/miniature_web");
                $web->setMiniature($miniature_web_name);
            };
            // TODO : Modification de la mini impossible, jsp pq


            $em->persist($web);
            $em->flush();
            return $this->redirectToRoute('admin');
        }
        
        return $this->render('admin/web_form.html.twig', [
            "webcreas" => $webs,
            "webcrea_form" => $web_form->createView()
        ]);
    }


    /**
     * @Route("/admin/graphic_create", name="admin_graphic_create")
     * @Route("/admin/{id}/graphic_edit", name="admin_graphic_edit")
     */
    public function graphicAdmin(GraphicCreation $graphic = null, Request $request, FileUploader $fileUploader)
    {
        $em = $this->getDoctrine()->getManager();

        $graphic_repo = $this->getDoctrine()->getRepository(GraphicCreation::class);
        $graphics = $graphic_repo->findAll();

        if(!$graphic){
            $graphic = New GraphicCreation();
        }

        $graphic_form = $this->createFormBuilder($graphic)
                         ->add('name')
                         ->add('client')
                         ->add('categorie', ChoiceType::class, [
                            'choices'=> [
                                'logo' => 'logo',
                                'identite_visuelle' => 'identité visuelle',
                                'autres' => 'autres'
                            ]
                        ])
                         ->add('miniature', FileType::class, [
                            'label' => 'Miniature (Jpg/Jpeg file)',
                            'mapped' => false,
                            "required" => false,
                            "constraints" => [
                                new File([
                                    'maxSize' => '1G',
                                    'mimeTypes' => [
                                        'image/jpeg',
                                        'image/png',
                                        'image/jpg',
                                    ],
                                    'mimeTypesMessage' => 'Please send Jpeg or PNG file',
                                ])
                            ],
                        ])
                         ->add('description')
                         ->add('url')
                         ->add('save', SubmitType::class,[
                            "label"=>'Envoyer',
                            "attr"=>[
                                'class'=>'button'
                            ]
                        ])
                         ->getForm();
            
        $graphic_form->handleRequest($request);
        
        if($graphic_form->isSubmitted() && $graphic_form->isValid()){
            if(!$graphic->getId()){
                $graphic->setCreatedAt (new \DateTime('now'));
                
                $miniature_graphic = $graphic_form["miniature"]->getData();
                $miniature_graphic_name = $fileUploader->upload($miniature_graphic, "img/miniature_graphic");
                $graphic->setMiniature($miniature_graphic_name);
            };
            // TODO : Modification de la mini impossible, jsp pq, tout ce modifie pafait sauf la miniature


            $em->persist($graphic);
            $em->flush();
            return $this->redirectToRoute('admin');
        }
        
    
        return $this->render('admin/graphic_form.html.twig', [
            "graphiccreas" => $graphics,
            "graphiccrea_form" => $graphic_form->createView()
        ]);  
    }
    
    
    /**
     * @Route("/admin/messages", name="messages")
     */
    public function messages(Request $request)
    {
       
        $message_repo = $this->getDoctrine()->getRepository(Message::class);
        $messages = $message_repo->findAll();

    
    
        return $this->render('admin/messages.html.twig', [
            "messages" => $messages,
        ]);

        
    }

    /**
     * @Route("/admin/is_read/{id}", name="is_read")
     */
    public function message_is_read($id)
    {

        $em = $this->getDoctrine()->getManager();

        $message_repo = $this->getDoctrine()->getRepository(Message::class);
        $message = $message_repo->Find($id);

        if(!$id)
        {
            throw $this->createNotFoundException('No ID found');
        }


        if($message != null)
        {
            $message->setIsRead('true');

            $em->persist($message);
            $em->flush();
        }

        return $this->redirectToRoute('messages');
    }

    /**
     * @Route("/admin/graphiccrea_delete/{id}", name="graphiccrea_delete")
     */
    public function deleteGraphicCreation($id)
    {

        $em = $this->getDoctrine()->getManager();

        $graphiccrea_repo = $this->getDoctrine()->getRepository(GraphicCreation::class);
        $graphiccrea = $graphiccrea_repo->Find($id);

        if(!$id)
        {
            throw $this->createNotFoundException('No ID found');
        }


        if($graphiccrea != null)
        {
            $em->remove($graphiccrea);
            $em->flush();
        }

        return $this->redirectToRoute('admin');
    }

    /**
     * @Route("/admin/webcrea_delete/{id}", name="webcrea_delete")
     */
    public function deleteWebCreation($id)
    {

        $em = $this->getDoctrine()->getManager();

        $webcrea_repo = $this->getDoctrine()->getRepository(WebCreation::class);
        $webcrea = $webcrea_repo->Find($id);

        if(!$id)
        {
            throw $this->createNotFoundException('No ID found');
        }

        if($webcrea != null)
        {
            $em->remove($webcrea);
            $em->flush();
        }

        return $this->redirectToRoute('admin');
    }

    /**
     * @Route("/admin/message_delete/{id}", name="message_delete")
     */
    public function deleteMessage($id)
    {

        $em = $this->getDoctrine()->getManager();

        $message_repo = $this->getDoctrine()->getRepository(Message::class);
        $message = $message_repo->Find($id);

        if(!$id)
        {
            throw $this->createNotFoundException('No ID found');
        }

        if($message != null)
        {
            $em->remove($message);
            $em->flush();
        }

        return $this->redirectToRoute('messages');
    }


}
