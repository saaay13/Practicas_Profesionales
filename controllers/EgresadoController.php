<?php
namespace Controllers;
use Model\Egresado;
use MVC\Router;

class EgresadoController {
    public static function Index(Router $router){   
        $egresado = Egresado::listarConUsuario();
        $router->render('egresado/index', [
            'egresado' => $egresado
        ]);
    }
}

?>
