<?php
namespace Controllers;
use Model\Estudiante; 
use MVC\Router;

class EstudianteController {
    public static function Index(Router $router){   
        $estudiante = Estudiante::listarConUsuario();
        $router->render('estudiante/index', [
            'estudiante' => $estudiante
        ]);
    }
    public static function Editar(Router $router) {
    $id_estudiante = $_GET['id_estudiante'] ?? null;
    if (!$id_estudiante) {
        header('Location: /estudiante');
        exit;
    }

    $estudiante = Estudiante::find($id_estudiante);
    if (!$estudiante) {
        header('Location: /estudiante');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $estudiante->sincronizar($_POST['estudiante']);
        $estudiante->actualizar();
        header('Location: /estudiante');
        exit;
    }

    $router->render('estudiante/editar', [
        'estudiante' => $estudiante
    ]);
}

}
?>
