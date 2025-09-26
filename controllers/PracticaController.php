<?php
namespace Controllers;
use Model\Practica; 
use MVC\Router;
class PracticaController{
    public static function Index(Router $router){   
    $practica = Practica::listarConUsuarioGeneral('id_supervisor', 'nombre_supervisor',
     'apellido_supervisor','email_supervisor');
        $router->render('practica/index',[
            'practica' => $practica
        ]);
    }
    
}

?>