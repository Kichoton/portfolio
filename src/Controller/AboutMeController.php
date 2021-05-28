<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutMeController extends AbstractController
{
    /**
     * @Route("/about_me", name="about_me")
     */
    public function index(): Response
    {
        return $this->render('about_me/index.html.twig', [
            'controller_name' => 'AboutMeController',
        ]);
    }
}
