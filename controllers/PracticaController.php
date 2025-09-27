<?php
namespace Controllers;
use Model\Postulacion;
use Model\Practica; 
use Model\Usuario;
use MVC\Router;
class PracticaController{
   public static function Index(Router $router){   
    $practica = Practica::listarPracticasActivas(); // trae estudiante y supervisor
    $router->render('practica/index', [
        'practica' => $practica
    ]);
}

        public static function Crear(Router $router)
        {
         $practica = new Practica();

     if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $practica = new Practica($_POST['practica']);
        $resultado = $practica->crear(); // Método que guarda la práctica
        if ($resultado) {
            $id_practica = $resultado; 
Practica::actualizarEstadoFinalizado($id_practica);

            header('Location: /practica');
            exit;
        }
    }
    $postulacion =Postulacion::listar() ;
    $usuario=Usuario::listarConRol() ;
    $usuarioFiltrado = array_filter($usuario, function($u) {
    return strtolower($u['nombre_rol']) === 'empresa' || $u['id_rol'] == 2;
});               $router->render('practica/crear', [
                'practica' => $practica,
                'postulacion'=> $postulacion,
                'usuario'=> $usuarioFiltrado
            ]);
        }
}


?>