<?php
namespace Controllers;

use Model\Convocatoria;
use Model\Usuario;
use Model\Rol;
use MVC\Router;

require_once __DIR__ . '/../includes/auth.php';
class UsuarioController {

    public static function Index(Router $router) {
        \verificarRol([1]); 
        if (session_status() === PHP_SESSION_NONE) session_start();
        $usuario = Usuario::listarConRol();
        $router->render('usuario/index', [
            'usuario' => $usuario
        ]);
    }

public static function Crear(Router $router) {
    if (session_status() === PHP_SESSION_NONE) session_start();

    $usuario = new Usuario();

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $usuario = new Usuario($_POST['usuario']);

        if (isset($usuario->autenticado)) {
            unset($usuario->autenticado);
        }

        $resultado = $usuario->crear();

        if ($resultado) {
$id_usuario = $usuario->id_usuario; // el PK recién creado
$id_rol = $_POST['usuario']['id_rol']; // este es el ID del rol, no el texto

if ($id_rol == 4 && isset($_POST['estudiante'])) { 
    $estudiante = new \Model\Estudiante($_POST['estudiante']);
    $estudiante->id_estudiante = $id_usuario; // FK igual al usuario
    $estudiante->crear();
}

if ($id_rol == 3 && isset($_POST['egresado'])) { 
    $egresado = new \Model\Egresado($_POST['egresado']);
    $egresado->id_egresado = $id_usuario; // FK igual al usuario
    $egresado->crear();
}



            header('Location: /usuario');
            exit;
        }
    }

    $rol = Rol::listar();
    $router->render('usuario/crear', [
        'usuario' => $usuario,
        'rol' => $rol
    ]);
}

     public static function Nosotros(Router $router)
    {
        $router->render("user/nosotros/index");
    }
    public static function Editar(Router $router) {
    $id_usuario = $_GET['id_usuario'] ?? null;
    if (!$id_usuario) {
        header('Location: /usuario');
        exit;
    }

    $usuario = Usuario::find($id_usuario);
    if (!$usuario) {
        header('Location: /usuario');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $data = $_POST['usuario'];

        unset($data['id_rol']);

        $usuario->sincronizar($data);
        $resultado = $usuario->actualizar();

        if ($resultado) {
            header('Location: /usuario');
            exit;
        }
    }

    $rol = Rol::listar();

    $router->render('usuario/editar', [
        'usuario' => $usuario,
        'rol' => $rol
    ]);
}
public static function Eliminar(Router $router) {
    $id_usuario = $_GET['id_usuario'] ?? null;
    if (!$id_usuario) {
        header('Location: /usuario');
        exit;
    }

    $usuario = Usuario::find($id_usuario);
    if (!$usuario) {
        header('Location: /usuario');
        exit;
    }

    try {
        $eliminado = $usuario->eliminar();

        if ($eliminado) {
            $_SESSION['mensaje'] = "Usuario eliminado correctamente";
            header('Location: /usuario');
            exit;
        } else {
            $_SESSION['error'] = "No se pudo eliminar el usuario";
            header('Location: /usuario');
            exit;
        }
    } catch (\Exception $e) {
        $_SESSION['error'] = "Error al eliminar el usuario: " . $e->getMessage();
        header('Location: /usuario');
        exit;
    }
}

}
