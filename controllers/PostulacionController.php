<?php
namespace Controllers;
use Model\Convocatoria;
use Model\Postulacion; 
use Model\Usuario;
use MVC\Router;
class PostulacionController{
    public static function Index(Router $router){ 
                     \verificarRol(rolesPermitidos: [1,2,3,4]); 
    $postulacion = Postulacion::listarConUsuarioGeneral('id_usuario',
     'nombre_usuario', 'apellido_usuario','email_usuario');
        $router->render('postulacion/index',[
            'postulacion' => $postulacion
        ]);
    }
    public static function Crear(Router $router)
        {
    \verificarRol(rolesPermitidos: [1,2,3,4]); 

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
  \verificarRol(rolesPermitidos: [1,2]); 

    if (session_status() === PHP_SESSION_NONE) session_start();
    
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

        if (isset($data['estado']) && !empty($data['estado'])) {
            try {
                $data['estado'] = \Model\EstadoPostulacion::from(strtolower($data['estado']));
            } catch (\ValueError $e) {
                $data['estado'] = \Model\EstadoPostulacion::EN_REVISION; // Valor por defecto
            }
        }

        $postulacion->sincronizar($data);
        $resultado = $postulacion->actualizar();

        if ($resultado) {
            \Model\ActivaModelo::actualizarEstadosConvocatoria($postulacion->id_postulacion);

            $rol = $_SESSION['rol'] ?? null;

            if ($rol == 2) {
                header('Location: /empresa/mispostulaciones');
            } else {
                header('Location: /postulacion');
            }
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
  \verificarRol(rolesPermitidos: [1,2]); 
    if (session_status() === PHP_SESSION_NONE) session_start();

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
    try {
        $eliminado = $postulacion->eliminar();

        $rol = $_SESSION['rol'] ?? null;

        if ($eliminado) {
            if ($rol == 2) {
                header('Location: /empresa/mispostulaciones');
            } else {
                header('Location: /postulacion');
            }
            exit;
        } else {
            $_SESSION['error'] = "No se pudo eliminar la postulación";
            header('Location: /postulacion');
            exit;
        }
    } catch (\Exception $e) {
        $_SESSION['error'] = "Error al eliminar la postulación: " . $e->getMessage();
        header('Location: /postulacion');
        exit;
    }
}

public static function IndexPost(Router $router) {
\verificarRol(rolesPermitidos: [1,2]); 

    if (session_status() === PHP_SESSION_NONE) session_start();
    $id_usuario = $_SESSION['id_usuario'] ?? null;
    if (!$id_usuario) {
        header('Location: /login');
        exit;
    }
    $rol = $_SESSION['rol'] ?? null;
    $postulaciones = Postulacion::IndexPostulaciones($id_usuario);

    $router->render('user/postulaciones/index', [
        'postulaciones' => $postulaciones,
        'rol' => $rol 
    ]);
}
public static function IndexPostula(Router $router) {
\verificarRol(rolesPermitidos: [1,2,3,4]); 

    if (session_status() === PHP_SESSION_NONE) session_start();
    $id_usuario = $_SESSION['id_usuario'] ?? null;
    if (!$id_usuario) {
        header('Location: /login');
        exit;
    }
    $rol = $_SESSION['rol'] ?? null;
    $postulaciones = Postulacion::IndexPostulacion($id_usuario);

    $router->render('user/postulaciones/index', [
        'postulaciones' => $postulaciones,
        'rol' => $rol 
    ]);
}
}
?>