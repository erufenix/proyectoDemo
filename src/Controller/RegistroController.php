<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistroController extends AbstractController
{
    /**
     * @Route("/registro", name="app_registro")
     */
    public function index()
    {
        return $this->render('registro/index.html.twig', [
            'controller_name' => 'RegistroController',
        ]);
    }

    /**
     * @Route("/registro/add",
     *      name="registro_add",
     *      methods="POST"
     * )
     */
    public function registro_add(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $status     = false;
        $message    = 'No se pudo ejecutar la acción'; 

        $registro = new User();
        $registro->setFullname($request->request->get('fullname'));
        $registro->setEmail($request->request->get('email'));
        $password = $this->encoder->encodePassword($user, $request->request->get('password'));

        $entityManager  = $this->getDoctrine()->getManager();
        $entityManager->persist($registro);
        $entityManager->flush();

        if($registro){
            $status = true;
            $message = 'Se creo el registro correctamente'; 
        }

        return new JsonResponse(
            [
              'status'  => $status,
              'message' => $message,
              'data'    => ''  
            ],200
        );
    }    
}
