<?php
namespace Controllers;
use Model\Convocatoria;
use Model\Empresa;
use MVC\Router;
class ConvocatoriaController{
    public static function Index(Router $router){   
        $convocatoria =Convocatoria::listarConEmpresa();
        $router->render('convocatoria/index',[
            'convocatoria' => $convocatoria
        ]);
    }
    public static function IndexUser(Router $router){   
        $convocatoria =Convocatoria::listarConEmpresa();
        $router->render('user/convocatoria/index',[
            'convocatoria' => $convocatoria
        ]);
    }
     public static function Crear(Router $router)
{
    $convocatoria= new Convocatoria();

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $convocatoria = new Convocatoria($_POST['convocatoria']);

        $nombre_imagen = $_FILES['imagen']['name'];
        $ubicacion = __DIR__ . '/../public/img/' . $nombre_imagen;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ubicacion);

        $convocatoria->setImagen($nombre_imagen);
        $resultado = $convocatoria->crear();

        if ($resultado) {
            $id_convocatoria = $resultado; 
            Convocatoria::actualizarEstadoSiTodasAceptadas($id_convocatoria);
            header('Location: /convocatoria');
            exit;
        }
    }
    $empresa=Empresa::listar() ;
    $router->render('convocatoria/crear', [
        'convocatoria' => $convocatoria,
        'empresa'=> $empresa
    ]);
}
}

?>