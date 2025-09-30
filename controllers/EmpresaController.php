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
    $empresa= new Empresa();

   if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $data = $_POST['empresa'];

    // Aseguramos que verificada tenga valor booleano
    $data['verificada'] = isset($data['verificada']) ? 1 : 0;

    $empresa = new Empresa($data);

    $nombre_imagen = $_FILES['imagen']['name'];
    if ($nombre_imagen) {
        $ubicacion = __DIR__ . '/../public/img/' . $nombre_imagen;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ubicacion);
        $empresa->setImagen($nombre_imagen);
    }

    $resultado = $empresa->crear();
    if ($resultado) {
        header('Location: /empresa');
        exit;
    }
}

    $usuario=Usuario::listarConRol() ;
    $usuariosEmpresa = array_filter($usuario, function($u) {
        return strtolower($u['nombre_rol']) === 'empresa' || $u['id_rol'] == 2;
    });
    $router->render('empresa/crear', [
        'empresa' => $empresa,
        'usuario'=> $usuariosEmpresa
    ]);
}


public static function Editar(Router $router) {
    $id_empresa = $_GET['id'] ?? null;
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

        // Aseguramos que verificada tenga valor booleano
        $data['verificada'] = isset($data['verificada']) ? 1 : 0;

        $empresa->sincronizar($data);

        // Manejo de imagen si se sube una nueva
        $nombre_imagen = $_FILES['imagen']['name'] ?? '';
        if ($nombre_imagen) {
            $ubicacion = __DIR__ . '/../public/img/' . $nombre_imagen;
            move_uploaded_file($_FILES['imagen']['tmp_name'], $ubicacion);
            $empresa->setImagen($nombre_imagen);
        }

        $resultado = $empresa->actualizar();

        if ($resultado) {
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
public static function Eliminar(Router $router) {
    $id_empresa = $_GET['id'] ?? null;
    if (!$id_empresa) {
        header('Location: /empresa');
        exit;
    }

    $empresa = Empresa::find($id_empresa);
    if (!$empresa) {
        header('Location: /empresa');
        exit;
    }

    $resultado = $empresa->eliminar(); 
    header('Location: /empresa');
    exit;
}

}
?>