<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PanelController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index()
    {
        return $this->render('panel/index.html.twig', [
            'users' => $this->getDoctrine()->getRepository(User::class)->findAll()
        ]);
    }

 /**
     * @Route("/registro/get/{id}",                                                                                                                                                                                                                                                    
     *      name="registro_get",
     *      methods="POST"
     * )
     */
    public function registro_get(Request $request, User $usuario){
        $status     = false;
        $message    = 'No se pudo ejecutar la acción';
        $data       = [];
        if($request->isXmlHttpRequest()){
          $page = $this->render('panel/user_edit_form.html.twig',[
              'usuario' => $usuario
          ])->getContent();    
          try {

            
            if($usuario){
              $status   = true;
              $message  = 'Datos';
              $html     = $page;
           }
            
          } catch (\Exception $error) {
            $status   = false;
            $message  = $error;
            $html     = $html;
          }
          
        }         
        
          return new JsonResponse(
              [
                'status'  => $status,
                'message' => $message,
                'html'    => $html
              ],200
          );
      }    
    
}
