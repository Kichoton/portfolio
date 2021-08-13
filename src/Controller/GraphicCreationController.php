<?php

namespace App\Controller;

use App\Entity\GraphicCreation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GraphicCreationController extends AbstractController
{
    /**
     * @Route("/graphisme", name="graphic_creation")
     */
    public function index(): Response
    {
        $graphic_repo = $this->getDoctrine()->getRepository(GraphicCreation::class);
        $graphics = $graphic_repo->findAll();
    
        return $this->render('graphic_creation/index.html.twig', [
            "graphics" => $graphics,
        ]);
    }

    /**
     * @Route("/graphic/{slug}", name="graphic_single")
     */
    public function single_graphic($slug): Response
    {
       
        $graphic_repo = $this->getDoctrine()->getRepository(GraphicCreation::class);
        $graphic = $graphic_repo->findOneBy(array('slug' => $slug));

    
        return $this->render('graphic_creation/graphic_single.html.twig', [
            "graphic" => $graphic,
        ]);
    }
}
