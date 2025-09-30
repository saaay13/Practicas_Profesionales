<?php 
namespace Controllers;
use MVC\Router;
use Model\Usuario;
use Model\Rol;
class LoginController{

    public static function login( Router $router ): void
    {
        $errores=[];
        if ($_SERVER["REQUEST_METHOD"]=="POST")
        {
            $postData = filter_input_array(INPUT_POST,[
                'email' => FILTER_SANITIZE_EMAIL,
                'password'=> FILTER_UNSAFE_RAW ]) ?? [];
            $auth = new Usuario($postData, false);
            $errores = $auth->validar();
            if(empty($errores))
            {
                $resultado =$auth->existeUsuario();
                if(!$resultado  )
                {
                    $errores= Usuario::getErrores();
                }
                else
                {
                    $auth->comprobarPassword($resultado);
                    if($auth->autenticado ?? false)
                    {
                        $auth->autenticar();
                        return;
                    }
                    else
                    {
                        $errores= Usuario::getErrores();
                    }
                }
            }
                  
        }
        $router->render('login',
        [
            'errores'=> $errores
        ]);
        

    }

    public static function logout() {
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }
        session_destroy();
        header('Location: /');
        exit;
    }
public static function Insertar(Router $router) {
    if (session_status() === PHP_SESSION_NONE) session_start();
    $usuario = new Usuario();
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $usuario = new Usuario($_POST['usuario']);
        if (isset($usuario->autenticado)) {
            unset($usuario->autenticado);
        }
        $resultado = $usuario->crear();
        if ($resultado) {
$id_usuario = $usuario->id_usuario; 
$id_rol = $_POST['usuario']['id_rol']; 
if ($id_rol == 4 && isset($_POST['estudiante'])) { 
    $estudiante = new \Model\Estudiante($_POST['estudiante']);
    $estudiante->id_estudiante = $id_usuario; 
    $estudiante->crear();
}
if ($id_rol == 3 && isset($_POST['egresado'])) { 
    $egresado = new \Model\Egresado($_POST['egresado']);
    $egresado->id_egresado = $id_usuario; 
    $egresado->crear();
}
            header('Location: /login');
            exit;
        }
    }

$rol = array_filter(Rol::listar(), function($r) {
    return in_array($r['id_rol'], [2, 3, 4]);
});
    $router->render('registro', [
        'usuario' => $usuario,
        'rol' => $rol
    ]);
}

 }


?>