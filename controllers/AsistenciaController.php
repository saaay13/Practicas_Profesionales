<?php
//MIOS
namespace Controllers;
use Model\Asistencia; 
use MVC\Router;
class AsistenciaController{
    public static function Index(Router $router){   
        $asistencia = Asistencia::listar();
        $router->render('asistencia/index',[
            'asistencia' => $asistencia
        ]);
    }
}

?>