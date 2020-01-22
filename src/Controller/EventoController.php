<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EventoController extends AbstractController
{
    /**
     * @Route("/evento", name="evento")
     */
    public function index()
    {
        $eventos = array();
        return $this->render('evento/index.html.twig', [
            'controller_name'   => 'EventoController',
            'eventos'           => $eventos
        ]);
    }
}
