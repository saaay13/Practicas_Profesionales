<?php
namespace Controllers;
use Model\Egresado;
use MVC\Router;

class EgresadoController {
    public static function Index(Router $router){   
        $egresado = Egresado::listarConUsuario();
        $router->render('egresado/index', [
            'egresado' => $egresado
        ]);
    }
    public static function Editar(Router $router) {
    $id_egresado = $_GET['id_egresado'] ?? null;
    if (!$id_egresado) {
        header('Location: /egresado');
        exit;
    }

    $egresado = Egresado::find($id_egresado);
    if (!$egresado) {
        header('Location: /egresado');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $egresado->sincronizar($_POST['egresado']);
        $egresado->actualizar();
        header('Location: /egresado');
        exit;
    }

    $router->render('egresado/editar', [
        'egresado' => $egresado
    ]);
}

}

?>
