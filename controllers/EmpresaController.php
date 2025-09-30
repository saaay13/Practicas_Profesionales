<?php
namespace Controllers;
use Model\Convocatoria;
use Model\Empresa;
use Model\Usuario;
use MVC\Router;
class EmpresaController{
    public static function Index(Router $router){  

        $empresa = Empresa::listarConUsuarioE();
        $router->render('empresa/index',[
            'empresa' => $empresa
        ]);
    }
    public static function IndexUser(Router $router){   

        $empresa = Empresa::listarConUsuarioE();
        $convocatoria = Convocatoria::listar();
        $router->render("user/inicio/index", [
            'empresa' => $empresa,
            'convocatoria' => $convocatoria
        ]);
    }
     public static function Public(Router $router){  
        $empresa = Empresa::listarConUsuarioE();
        $router->render('user/inicio/panel',[
            'empresa' => $empresa
        ]);
    }
public static function Crear(Router $router)
{
    \verificarRol(rolesPermitidos: [1,2]); 

    $empresa = new Empresa();

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $data = $_POST['empresa'];

        $data['verificada'] = isset($data['verificada']) ? 1 : 0;

        $empresa = new Empresa($data);

        if (!empty($_FILES['imagen']['name'])) {
            $nombre_imagen = uniqid() . "_" . basename($_FILES['imagen']['name']);
            $carpeta = __DIR__ . '/../public/img/empresa/';
            if (!is_dir($carpeta)) {
                mkdir($carpeta, 0777, true);
            }
            $ubicacion = $carpeta . $nombre_imagen;
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ubicacion)) {
                $empresa->setImagen($nombre_imagen);
            } else {
                $_SESSION['error'] = "Error al subir la imagen";
                header('Location: /empresa/crear');
                exit;
            }
        }
        $resultado = $empresa->crear();
        if ($resultado) {
            header('Location: /empresa');
            exit;
        }
    }
    $usuario = Usuario::listarConRol();
    $usuariosEmpresa = array_filter($usuario, function($u) {
        return strtolower($u['nombre_rol']) === 'empresa' || $u['id_rol'] == 2;
    });

    $router->render('empresa/crear', [
        'empresa' => $empresa,
        'usuario' => $usuariosEmpresa
    ]);
}
public static function Editar(Router $router) {
    \verificarRol(rolesPermitidos: [1,2]); 

    $id_empresa = $_GET['id_empresa'] ?? null;
    if (!$id_empresa) {
        header('Location: /empresa');
        exit;
    }
    $empresa = Empresa::find($id_empresa);
    if (!$empresa) {
        header('Location: /empresa');
        exit;
    }
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $data = $_POST['empresa'];

        $data['verificada'] = isset($data['verificada']) ? 1 : 0;

        $empresa->sincronizar($data);

        if (!empty($_FILES['imagen']['name'])) {
            $nombre_imagen = uniqid() . "_" . basename($_FILES['imagen']['name']);
            $carpeta = __DIR__ . '/../public/img/empresa/';

            if (!is_dir($carpeta)) {
                mkdir($carpeta, 0777, true);
            }

            $ubicacion = $carpeta . $nombre_imagen;

            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ubicacion)) {
                if (!empty($empresa->imagen) && file_exists($carpeta . $empresa->imagen)) {
                    unlink($carpeta . $empresa->imagen);
                }
                $empresa->setImagen($nombre_imagen);
            } else {
                $_SESSION['error'] = "Error al subir la imagen";
                header("Location: /empresa/editar?id={$empresa->id_empresa}");
                exit;
            }
        }
        $resultado = $empresa->actualizar();

        if ($resultado) {
            $_SESSION['mensaje'] = "Empresa actualizada correctamente";
            header('Location: /empresa');
            exit;
        }
    }

    $usuario = Usuario::listarConRol();
    $usuariosEmpresa = array_filter($usuario, function($u) {
        return strtolower($u['nombre_rol']) === 'empresa' || $u['id_rol'] == 2;
    });

    $router->render('empresa/editar', [
        'empresa' => $empresa,
        'usuario' => $usuariosEmpresa
    ]);
}

    public static function IndexEmpresas(Router $router){   
    if (session_status() === PHP_SESSION_NONE) session_start();

    if (!isset($_SESSION['id_usuario'])) {
        header('Location: /login');
        exit;
    }
    $id_usuario = $_SESSION['id_usuario'];
    $empresa = Empresa::listarMisEmpresas($id_usuario);

    $router->render('user/inicio/panel', [
        'empresa' => $empresa
    ]);
    
}
public static function Eliminar(Router $router) {
    \verificarRol(rolesPermitidos: [1,2]); 

    $id_empresa = $_GET['id_empresa'] ?? null;
    if (!$id_empresa) {
        header('Location: /empresa');
        exit;
    }

    $empresa = Empresa::find($id_empresa);
    if (!$empresa) {
        header('Location: /empresa');
        exit;
    }

    try {
        $eliminado = $empresa->eliminar();

        if ($eliminado) {
            $_SESSION['mensaje'] = "Empresa eliminada correctamente";
            header('Location: /empresa');
            exit;
        } else {
            $_SESSION['error'] = "No se pudo eliminar la empresa";
            header('Location: /empresa');
            exit;
        }
    } catch (\Exception $e) {
        $_SESSION['error'] = "Error al eliminar el otros: " . $e->getMessage();
        header('Location: /empresa');
        exit;
    }
}
}
?>