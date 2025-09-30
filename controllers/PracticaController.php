<?php
namespace Controllers;
use Model\Postulacion;
use Model\Practica; 
use Model\Usuario;
use MVC\Router;
class PracticaController{
   public static function Index(Router $router){ 
\verificarRol(rolesPermitidos: [1,2]); 
  
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
    
    $id_postulacion = $practica->id_postulacion;
$id_supervisor = Postulacion::obtenerEncargado($id_postulacion);

if (!$id_supervisor) {
    echo "No se pudo asignar un encargado a la práctica.";
    return;
}

$practica->id_supervisor = $id_supervisor;

            $resultado = $practica->crear();
            if ($resultado) {
                $id_practica = $resultado; 
                Practica::actualizarEstadoFinalizado($id_practica);
                header('Location: /practica');
                exit;
            }
        }

        $postulacion = Postulacion::listarAceptadas();
        $usuariosFiltrados = [];
        if (!empty($postulacion)) {
            foreach ($postulacion as $p) {
                $id_representante = Postulacion::obtenerEncargado($p['id_postulacion']);
                if ($id_representante) {
                    $usuario = Usuario::find($id_representante);
                    if ($usuario) $usuariosFiltrados[$p['id_postulacion']] = $usuario;
                }
            }
        }
            
        $router->render('practica/crear', [
            'practica' => $practica,
            'postulacion'=> $postulacion,
            'usuario'=> $usuariosFiltrados
        ]);

    }

public static function Editar(Router $router) {
    $id_practica = $_GET['id_practica'] ?? null;
    if (!$id_practica) {
        header('Location: /practica');
        exit;
    }

    $practica = Practica::find($id_practica); 
    if (!$practica) {
        header('Location: /practica'); 
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $data = $_POST['practica'];
        $practica->sincronizar($data);
        $resultado = $practica->actualizar();

        if ($resultado) {
            header('Location: /practica');
            exit;
        }
    }

$postulaciones = Postulacion::listarAceptadas();
    $usuarios = Usuario::listarConRol();
    $usuariosFiltrados = array_filter($usuarios, fn($u) => strtolower($u['nombre_rol']) === 'empresa' || $u['id_rol'] == 2);

    $router->render('practica/editar', [
        'practica' => $practica,
        'postulacion' => $postulaciones,
        'usuario' => $usuariosFiltrados
    ]);
}


   public static function Eliminar(Router $router) {
    $id_practica = $_GET['id_practica'] ?? null;
    if (!$id_practica) {
        header('Location: /practica');
        exit;
    }

    $practica = Practica::find($id_practica);
    if (!$practica) {
        header('Location: /practica');
        exit;
    }

    try {
        $eliminado = $practica->eliminar();

        if ($eliminado) {
            $_SESSION['mensaje'] = "Practica eliminada correctamente";
            header('Location: /practica');
            exit;
        } else {
            $_SESSION['error'] = "No se pudo eliminar el usuario";
            header('Location: /practica');
            exit;
        }
    } catch (\Exception $e) {
        $_SESSION['error'] = "Error al eliminar el otros: " . $e->getMessage();
        header('Location: /practica');
        exit;
    }
}

}


?>