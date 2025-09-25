<?php
namespace Controllers;
use Model\Practica; 
use MVC\Router;
class PracticaController{
    public static function Index(Router $router){   
        $practica = Practica::listar();
        $router->render('practica/index',[
            'practica' => $practica
        ]);
    }
    
}

?>