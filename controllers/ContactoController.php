<?php

namespace Controllers;

use Model\Contacto;
use Model\Usuario;
use MVC\Router;

class ContactoController
{
    public static function Index(Router $router)
    {
        \verificarRol(rolesPermitidos: [1]); 
        $contacto = Contacto::listarConUsuarioGeneral('id_usuario', 'nombre_contacto',
         'apellido_contacto');
        $router->render('mensaje/index', [
            'contactos' => $contacto
        ]);
    }
public static function Crear(Router $router)
{
     if (session_status() === PHP_SESSION_NONE) session_start();
    $contacto = new Contacto();

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $datos = $_POST['contacto'];
        if (isset($_SESSION['id_usuario'])) {
            $datos['id_usuario'] = $_SESSION['id_usuario'];
        } else {
            die("Debes iniciar sesión para enviar un contacto.");
        }
        $contacto = new Contacto($datos);
        $resultado = $contacto->crear();
        if ($resultado) {
            header('Location: /contacto/crear');
            exit;
        }
    }

    $router->render('user/contacto/index', [
        'contacto' => $contacto,
    ]);
}

   
}
