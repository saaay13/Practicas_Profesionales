<?php
namespace Controllers;
use Model\Convocatoria;
use Model\Empresa;
use MVC\Router;
class ConvocatoriaController{
    public static function Index(Router $router){
   
        $convocatoria =Convocatoria::listarConEmpresa();
        $router->render('convocatoria/index',[
            'convocatoria' => $convocatoria
        ]);
    }
    public static function IndexUser(Router $router){   

        $convocatoria =Convocatoria::listarConEmpresa();
        $router->render('user/convocatoria/index',[
            'convocatoria' => $convocatoria
        ]);
    }
    public static function IndexConvocatorias(Router $router){ 
                    \verificarRol(rolesPermitidos: [1,2,3,4]); 
  
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['id_usuario'])) {
        header('Location: /login');
        exit;
    }
    $id_usuario = $_SESSION['id_usuario'];
    $convocatoria = Convocatoria::listarMisConvocatorias($id_usuario);
    $router->render('user/convocatoria/index', [
        'convocatoria' => $convocatoria
    ]);
}
 
public static function Crear(Router $router)
{
    \verificarRol(rolesPermitidos: [1,2]); 
    if (session_status() === PHP_SESSION_NONE) session_start();
    $rol = $_SESSION['rol'] ?? null;
    $id_usuario = $_SESSION['id_usuario'] ?? null;
    $convocatoria = new Convocatoria();
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $convocatoria = new Convocatoria($_POST['convocatoria']);
        if (!empty($_FILES['imagen']['name'])) {
            $nombre_imagen = uniqid() . "_" . basename($_FILES['imagen']['name']);
            $carpeta = __DIR__ . '/../public/img/convocatoria/';

            if (!is_dir($carpeta)) mkdir($carpeta, 0777, true);

            $ubicacion = $carpeta . $nombre_imagen;

            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ubicacion)) {
                $convocatoria->setImagen($nombre_imagen);
            } else {
                $_SESSION['error'] = "Error al subir la imagen";
                header('Location: /convocatoria/crear');
                exit;
            }
        }

        $resultado = $convocatoria->crear();

        if ($resultado) {
            $id_convocatoria = $resultado;
            Convocatoria::actualizarEstado($id_convocatoria);
            if ($rol == 2) {
                header('Location: /empresa/misconvocatorias');
            } else {
                header('Location: /convocatoria');
            }
            exit;
        }
    }
    if ($rol == 2) {
        $empresa = Empresa::listarMisEmpresas($id_usuario);
    } else {
        $empresa = Empresa::listar();
    }

    $router->render('convocatoria/crear', [
        'convocatoria' => $convocatoria,
        'empresa' => $empresa
    ]);
}


public static function Editar(Router $router) {
    \verificarRol(rolesPermitidos: [1,2]); 
    session_start();
    $rol = $_SESSION['rol'] ?? null;
    $id_convocatoria = $_GET['id_convocatoria'] ?? null;
    if (!$id_convocatoria) {
        header('Location: /convocatoria');
        exit;
    }
    $convocatoria = Convocatoria::find($id_convocatoria);
    if (!$convocatoria) {
        header('Location: /convocatoria');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $convocatoria->sincronizar($_POST['convocatoria']);
        if (!empty($_FILES['imagen']['name'])) {
            $nombre_imagen = uniqid() . "_" . basename($_FILES['imagen']['name']);
            $carpeta = __DIR__ . '/../public/img/convocatoria/';

            if (!is_dir($carpeta)) {
                mkdir($carpeta, 0777, true);
            }
            $ubicacion = $carpeta . $nombre_imagen;
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ubicacion)) {
                if (!empty($convocatoria->imagen) && file_exists($carpeta . $convocatoria->imagen)) {
                    unlink($carpeta . $convocatoria->imagen);
                }
                $convocatoria->setImagen($nombre_imagen);
            } else {
                $_SESSION['error'] = "Error al subir la imagen";
                header("Location: /convocatoria/editar?id_convocatoria={$convocatoria->id_convocatoria}");
                exit;
            }
        }
        $convocatoria->actualizar();
        if ($rol == 2) {
            header('Location: /empresa/misconvocatorias');
        } else {
            header('Location: /convocatoria');
        }
        exit;
    }

    $empresa = Empresa::listar();
    $router->render('convocatoria/editar', [
        'convocatoria' => $convocatoria,
        'empresa' => $empresa
    ]);
}

public static function Eliminar(Router $router) {
    \verificarRol(rolesPermitidos: [1,2]); 

    session_start();
    $rol = $_SESSION['rol'] ?? null;

    $id_convocatoria = $_GET['id_convocatoria'] ?? null;
    if (!$id_convocatoria) {
        header('Location: /convocatoria');
        exit;
    }

    $convocatoria = Convocatoria::find($id_convocatoria);
    if (!$convocatoria) {
        header('Location: /convocatoria');
        exit;
    }

    try {
        $eliminado = $convocatoria->eliminar();

        if ($eliminado) {
            $_SESSION['mensaje'] = "Convocatoria eliminada correctamente";

            // Redirigir según el rol
            if ($rol == 2) {
                header('Location: /empresa/misconvocatorias');
            } else {
                header('Location: /convocatoria');
            }
            exit;
        } else {
            $_SESSION['error'] = "No se pudo eliminar la convocatoria";
            header('Location: /convocatoria');
            exit;
        }
    } catch (\Exception $e) {
        $_SESSION['error'] = "Error al eliminar la convocatoria: " . $e->getMessage();
        header('Location: /convocatoria');
        exit;
    }
}

}

?>