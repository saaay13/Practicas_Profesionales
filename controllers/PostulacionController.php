<?php
namespace Controllers;
use Model\Postulacion; 
use MVC\Router;
class PostulacionController{
    public static function Index(Router $router){   
    $postulacion = Postulacion::listarConUsuarioGeneral('id_usuario',
     'nombre_usuario', 'apellido_usuario','email_usuario');
        $router->render('postulacion/index',[
            'postulacion' => $postulacion
        ]);
    }
}

?>