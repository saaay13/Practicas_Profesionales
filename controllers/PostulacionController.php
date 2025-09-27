<?php
namespace Controllers;
use Model\Convocatoria;
use Model\Postulacion; 
use Model\Usuario;
use MVC\Router;
class PostulacionController{
    public static function Index(Router $router){   
    $postulacion = Postulacion::listarConUsuarioGeneral('id_usuario',
     'nombre_usuario', 'apellido_usuario','email_usuario');
        $router->render('postulacion/index',[
            'postulacion' => $postulacion
        ]);
    }
    public static function Crear(Router $router)
        {
         $postulacion = new Postulacion();

     if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $postulacion = new Postulacion($_POST['postulacion']);
        $resultado = $postulacion->crear(); 
        if ($resultado) {
            header('Location: /postulacion');
            exit;
        }
    }
    $convocatoria =Convocatoria::listar() ;
    $usuario=Usuario::listarConRol() ;
    $usuarioFiltrado = array_filter($usuario, function($u) {
    return strtolower($u['nombre_rol']) === 'egresado' 
        || strtolower($u['nombre_rol']) === 'estudiante'
        || $u['id_rol'] == 3
        || $u['id_rol'] == 4;
});   
         $router->render('postulacion/crear', [
                'postulacion' => $postulacion,
                'convocatoria'=> $convocatoria,
                'usuario'=> $usuarioFiltrado
            ]);
        }
public static function Editar(Router $router)
{
    $id_postulacion = (int)($_POST['postulacion']['id_postulacion'] ?? $_GET['id_postulacion'] ?? 0);
    if (!$id_postulacion) {
        header('Location: /postulacion');
        exit;
    }

    $postulacion = Postulacion::find($id_postulacion);

if (empty($postulacion)) {
    echo "No existe postulacion con id $id_postulacion";
    exit;
}


    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        if (isset($_POST['postulacion']['estado'])) {
            $estado = $_POST['postulacion']['estado'];
            // Aseguramos que sea un valor válido del Enum
            try {
                $_POST['postulacion']['estado'] = \Model\EstadoPostulacion::from($estado);
            } catch (\ValueError $e) {
                $_POST['postulacion']['estado'] = null;
            }
        }
        $postulacion->sincronizar($_POST['postulacion']);
        $resultado = $postulacion->editar();
        if ($resultado) {
            header('Location: /postulacion');
            exit;
        }
    }

    $convocatoria = Convocatoria::listar();
    $usuario = Usuario::listarConRol();
    $usuarioFiltrado = array_filter($usuario, function($u) {
        return strtolower($u['nombre_rol']) === 'egresado' 
            || strtolower($u['nombre_rol']) === 'estudiante'
            || $u['id_rol'] == 3
            || $u['id_rol'] == 4;
    });

    $router->render('postulacion/editar', [
        'postulacion' => $postulacion,
        'convocatoria'=> $convocatoria,
        'usuario'=> $usuarioFiltrado
    ]);
}

}
?>