<?php
namespace Controllers;
use Model\Convocatoria; 
use MVC\Router;
class ConvocatoriaController{
    public static function Index(Router $router){   
        $convocatoria =Convocatoria::listar();
        $router->render('convocatoria/index',[
            'convocatoria' => $convocatoria
        ]);
    }
    public static function IndexUser(Router $router){   
        $convocatoria =Convocatoria::listar();
        $router->render('user/convocatoria/index',[
            'convocatoria' => $convocatoria
        ]);
    }
}

?>