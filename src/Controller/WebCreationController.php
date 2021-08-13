<?php

namespace App\Controller;

use App\Entity\WebCreation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WebCreationController extends AbstractController
{
    /**
     * @Route("/web", name="web_creation")
     */
    public function index(): Response
    {
       
        $web_repo = $this->getDoctrine()->getRepository(WebCreation::class);
        $webs = $web_repo->findAll();
    
        return $this->render('web_creation/index.html.twig', [
            "webs" => $webs,
        ]);
    }

     /**
     * @Route("/web/{slug}", name="web_single")
     */
    public function single_web($slug): Response
    {
       
        $web_repo = $this->getDoctrine()->getRepository(WebCreation::class);
        $web = $web_repo->findOneBy(array('slug' => $slug));
    
        return $this->render('web_creation/web_single.html.twig', [
            "web" => $web,
        ]);
    }

}
