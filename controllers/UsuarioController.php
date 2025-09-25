<?php
namespace Controllers;

use Model\Usuario;
use Model\Rol;
use MVC\Router;

require_once __DIR__ . '/../includes/auth.php';
class UsuarioController {

    public static function Index(Router $router) {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $usuario = Usuario::listar();
        $router->render('usuario/index', [
            'usuario' => $usuario
        ]);
    }

    public static function Crear(Router $router) {
        if (session_status() === PHP_SESSION_NONE) session_start();
        //\verificarRol([1]); 


        $usuario = new Usuario();

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $usuario = new Usuario($_POST['usuario']);
            $resultado = $usuario->crear();
            if ($resultado) {
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
    
}
