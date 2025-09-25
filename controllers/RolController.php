<?php
namespace Controllers;
use Model\Rol; 
use MVC\Router;
class RolController{
    public static function Index(Router $router){   
        $rol = Rol::listar();
        $router->render('rol/index',[
            'rol' => $rol
        ]);
    }
    
}

?>