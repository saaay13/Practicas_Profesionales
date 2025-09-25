<?php
namespace Controllers;
use Model\Estudiante; 
use MVC\Router;
class EstudianteController{
    public static function Index(Router $router){   
        $estudiante= Estudiante::listarConUsuario();
        $router->render('estudiante/index',[
            'estudiante' => $estudiante
        ]);
    }
}

?>