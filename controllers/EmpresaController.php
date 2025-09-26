<?php
namespace Controllers;
use Model\Convocatoria;
use Model\Empresa;
use Model\Usuario;
use MVC\Router;
class EmpresaController{
    public static function Index(Router $router){   
        $empresa = Empresa::listarConUsuario();
        $router->render('empresa/index',[
            'empresa' => $empresa
        ]);
    }
    public static function IndexUser(Router $router){   
        $empresa = Empresa::listarConUsuario();
        $convocatoria = Convocatoria::listar();
        $router->render("user/inicio/index", [
            'empresa' => $empresa,
            'convocatoria' => $convocatoria
        ]);
    }
     public static function Public(Router $router){  
        $empresa = Empresa::listarConUsuario();
        $router->render('user/inicio/panel',[
            'empresa' => $empresa
        ]);
    }
     public static function Crear(Router $router)
{
    $empresa= new Empresa();

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $empresa = new Empresa($_POST['empresa']);

        $nombre_imagen = $_FILES['imagen']['name'];
        $ubicacion = __DIR__ . '/../public/img/' . $nombre_imagen;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ubicacion);
        $empresa->setImagen($nombre_imagen);
        $resultado = $empresa->crear();
        if ($resultado) {
            header('Location: /empresa');
            exit;
        }
    }
    $usuario=Usuario::listar() ;
    $router->render('empresa/crear', [
        'empresa' => $empresa,
        'usuario'=> $usuario
    ]);
}
}

?>