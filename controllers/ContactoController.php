<?php

namespace Controllers;

use Model\Contacto;
use MVC\Router;

class ContactoController
{
    public static function Index(Router $router)
    {
        \verificarRol([1]); 
        $contactos = Contacto::listar();
        $router->render('mensaje/index', [
            'contactos' => $contactos
        ]);
    }

    public static function Crear(Router $router)
    {
        $contacto = new Contacto();
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $contacto = new Contacto($_POST['contacto']);
            $resultado = $contacto->crear();

            if ($resultado) {
                header('Location: /contacto');
                exit;
            }
        }

        $router->render('user/contacto/index', [
            'contacto' => $contacto
        ]);
    }
}
