<?php
namespace Controllers;
require_once __DIR__ . '/../includes/database.php';
class AuthController {

    public static function loginForm($router = null) {
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    $mensaje = $_SESSION['mensaje'] ?? '';
    unset($_SESSION['mensaje']);

    // Bloquear el layout
    require __DIR__ . '/../views/sesion.php';
}


    public static function login() {
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $_SESSION['mensaje'] = "Complete todos los campos";
            header('Location: /login');
            exit;
        }

        $db = conectarDB();

        $stmt = $db->prepare("SELECT * FROM usuario WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $user = $resultado->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['usuario_activo'] = $user['id_usuario'];
            $_SESSION['nombre'] = $user['nombre'];
            $_SESSION['rol'] = $user['id_rol'];
            header('Location: /usuario');
            exit;
        } else {
            $_SESSION['mensaje'] = "Email o contraseña incorrecta";
            header('Location: /login');
            exit;
        }
    }

    public static function logout() {
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
        session_destroy();
        header('Location: /');
        exit;
    }
}
