<?php

namespace App\Controller;

use App\Entity\Evento;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
            'eventos'           => $this->getDoctrine()->getRepository(Evento::class)->findAll()
        ]);
    }
}
