<?php
function verificarRol($rolesPermitidos = []) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], $rolesPermitidos)) {
        header('Location: /error.php'); // o mostrar página de acceso denegado
        exit;
    }
}
