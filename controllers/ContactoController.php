<?php

namespace Controllers;

use Model\Contacto;
use MVC\Router;

class ContactoController
{
    public static function Index(Router $router)
    {
        $contactos = Contacto::listar();
        $router->render('user/contacto/index', [
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

        $router->render('user/contacto', [
            'contacto' => $contacto
        ]);
    }
}
