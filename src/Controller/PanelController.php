<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class PanelController extends AbstractController
{
    private $encoders; 
    private $normalizers; 
    private $serializer;
    private $status;    
    private $message;   
    private $data;
    private $html;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
        $this->encoders = [new XmlEncoder(), new JsonEncoder()];
        $this->normalizers = [new ObjectNormalizer()];
        $this->serializer = new Serializer($this->normalizers, $this->encoders);         
    }

    /**
     * @Route("/", name="app_home")
     */
    public function index()
    {
        return $this->render('panel/panel.html.twig', [
          'users' => $this->getDoctrine()->getRepository(User::class)->findAll()
      ]);
    }

    /**
     * @Route("/users", name="app_users")
     */
    public function all_users(){
        $users  = $this->getDoctrine()->getRepository(User::class)->findAll();
        $ausers = $this->serializer->serialize($users, 'json');
        return JsonResponse::fromJsonString($ausers);
    }


    /**
        * @Route("/registro/get/{id}",
        *      name="registro_get",
        *      methods="POST"
        * )
        */
    public function user_get(Request $request, User $usuario)
    {
        $this->status   = false;
        $this->message = 'No se pudo ejecutar la acción';
        $this->html    = '';
        if ($request->isXmlHttpRequest()) {
            $page = $this->render('panel/user_edit_form.html.twig', [
            'usuario' => $usuario,
            'raction' => 'Editando...'
        ])->getContent();
            try {
                if ($usuario) {
                    $this->status   = true;
                    $this->message  = 'Datos';
                    $this->html     = $page;
                }
            } catch (\Exception $error) {
                $this->status   = false;
                $this->message  = $error;
                $this->html     = $html;
            }
        }
      
        return new JsonResponse(
          [
              'status'  => $this->status,
              'message' => $this->message,
              'html'    => $this->html
            ],
          200
      );
    }
    
    /**
        * @Route("/user/update/{id}",
        *      name="user_edit",
        *      methods="POST"
        * )
        */
    public function user_update(Request $request, $id)
    {
        $this->status     = false;
        $this->message    = 'No se pudo ejecutar la acción';
        $this->data       = [];
        if ($request->isXmlHttpRequest()) {
            try {
                $user = $this->getDoctrine()->getRepository(User::class)->findOneById($id);
                $user->setFullname($request->request->get('fullName'));
                $user->setEmail($request->request->get('email'));
                $entityManager  = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
                if ($user) {
                    $this->status   = true;
                    $this->message  = 'Se creo el registro correctamente';
                    $this->data     = $this->serializer->serialize($user, 'json');
                }
            } catch (\Exception $error) {
                $this->status = false;
                $this->message = $error;
            }
        }

        return new JsonResponse(
          [
            'status'  => $this->status,
            'message' => $this->message,
            'data'    => $this->data
        ],200
      );
    }
}
