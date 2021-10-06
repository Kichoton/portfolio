<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnexController extends AbstractController
{
    /**
     * @Route("/kichoton", name="kichoton")
     */
    public function kichoton(): Response
    {
        return $this->render('annex/kichoton.html.twig', [
        ]);
    }

    /**
     * @Route("/bmx", name="bmx")
     */
    public function bmx(): Response
    {
        return $this->render('annex/bmx.html.twig', [
        ]);
    }
}
