<?php
//MIOS
namespace Controllers;
use Model\Asistencia; 
use MVC\Router;
class AsistenciaController{
    public static function Index(Router $router){   
        $asistencia = Asistencia::listarConUsuarioGeneral('verificado_por', 'nombre_verificador',
         'apellido_verificador','email_verificador');
        $router->render('asistencia/index',[
            'asistencia' => $asistencia
        ]);
    }
}

?>