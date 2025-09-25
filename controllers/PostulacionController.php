<?php
namespace Controllers;
use Model\Postulacion; 
use MVC\Router;
class PostulacionController{
    public static function Index(Router $router){   
        $postulacion = Postulacion::listar();
        $router->render('postulacion/index',[
            'postulacion' => $postulacion
        ]);
    }
}

?>