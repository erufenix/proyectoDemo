<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistroController extends AbstractController{

  public function __construct(UserPasswordEncoderInterface $encoder){
    $this->encoder = $encoder;
  }  

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
    public function registro_add(Request $request, UserPasswordEncoderInterface $encoder){
      $status     = false;
      $message    = 'No se pudo ejecutar la acción';
      $data       = [];
      $encoders = [new XmlEncoder(), new JsonEncoder()];
      $normalizers = [new ObjectNormalizer()];
      $serializer = new Serializer($normalizers, $encoders);      
      if($request->isXmlHttpRequest()){
        try {
          $registro = new User();
          $registro->setFullname($request->request->get('fullname'));
          $registro->setEmail($request->request->get('email'));
          $password = $this->encoder->encodePassword($registro, $request->request->get('password'));
          $registro->setPassword($password);
          $registro->setActive(true);
          $registro->setRoles(['ROLE_ADMIN']);
          $entityManager  = $this->getDoctrine()->getManager();
          $entityManager->persist($registro);
          $entityManager->flush();
          
          if($registro){
            $status   = true;
            $message  = 'Se creo el registro correctamente';
            $data     = $serializer->serialize($registro, 'json');    
         }
          
        } catch (\Exception $error) {
          $status   = false;
          $message  = $error;
          $data     = $data;
        }
        
      }         
      
        return new JsonResponse(
            [
              'status'  => $status,
              'message' => $message,
              'data'    => $data
            ],200
        );
    }    
}
