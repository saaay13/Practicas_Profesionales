<?php
namespace Controllers;
use Model\Rol; 
use MVC\Router;
class RolController{
    public static function Index(Router $router){  
        \verificarRol(rolesPermitidos: [1]); 
 
        $rol = Rol::listar();
        $router->render('rol/index',[
            'rol' => $rol
        ]);
    }
    
}

?>