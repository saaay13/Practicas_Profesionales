<?php
if (session_status() === PHP_SESSION_NONE) session_start();

function verificarRol(array $rolesPermitidos) {
    if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], $rolesPermitidos)) {
        $_SESSION['mensaje'] = "No tienes permisos para acceder a esta página";
        header('Location: /login');
        exit;
    }
}
