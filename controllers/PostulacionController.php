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


        public static function Editar(Router $router) {
    $id_postulacion = $_GET['id_postulacion'] ?? null;
    if (!$id_postulacion) {
        header('Location: /postulacion');
        exit;
    }

    $postulacion = Postulacion::find($id_postulacion);
    if (!$postulacion) {
        header('Location: /postulacion');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $data = $_POST['postulacion'];

        // Manejo seguro del enum
        if (isset($data['estado']) && !empty($data['estado'])) {
            try {
                $data['estado'] = \Model\EstadoPostulacion::from(strtolower($data['estado']));
            } catch (\ValueError $e) {
                $data['estado'] = \Model\EstadoPostulacion::EN_REVISION; // valor por defecto
            }
        }

        $postulacion->sincronizar($data);
        $resultado = $postulacion->actualizar();

        if ($resultado) {
        \Model\ActivaModelo::actualizarConvocatoriaYRechazarOtras($postulacion->id_postulacion);
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
        'convocatoria' => $convocatoria,
        'usuario' => $usuarioFiltrado
    ]);
}


public static function Eliminar(Router $router) {
    $id_postulacion = $_GET['id_postulacion'] ?? null;
    if (!$id_postulacion) {
        header('Location: /postulacion');
        exit;
    }

    $postulacion = Postulacion::find($id_postulacion);
    if ($postulacion) {
        try {
            // Se intenta eliminar solo la postulación
            $eliminado = $postulacion->eliminar();
            if ($eliminado) {
                header('Location: /postulacion');
                exit;
            } else {
                echo "No se pudo eliminar la postulación. Asegúrate de que no tenga prácticas asociadas.";
            }
        } catch (\mysqli_sql_exception $e) {
            echo "No se puede eliminar la postulación porque tiene registros relacionados: " . $e->getMessage();
        }
    } else {
        header('Location: /postulacion');
        exit;
    }
}

}
?>