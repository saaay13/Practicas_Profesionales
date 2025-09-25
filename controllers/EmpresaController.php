<?php
namespace Controllers;
use Model\Convocatoria;
use Model\Empresa; 
use MVC\Router;
class EmpresaController{
    public static function Index(Router $router){   
        $empresa = Empresa::listarConUsuario();
        $router->render('empresa/index',[
            'empresa' => $empresa
        ]);
    }
    public static function IndexUser(Router $router){   
        $empresas = Empresa::listar();
        $convocatorias = Convocatoria::listar();
        $router->render("user/inicio/index", [
            'empresas' => $empresas,
            'convocatorias' => $convocatorias
        ]);
    }
     public static function Public(Router $router){  
        $empresa = Empresa::listarConUsuario();
        $router->render('empresa/panel',[
            'empresa' => $empresa
        ]);
    }
}

?>