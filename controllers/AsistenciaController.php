<?php
namespace Controllers;

use Model\Asistencia; 
use Model\Practica;
use Model\Usuario;
use MVC\Router;

class AsistenciaController {
    public static function Index(Router $router){ 
    \verificarRol(rolesPermitidos: [1,2]); 
  
        $asistencia = Asistencia::listarConUsuarioGeneral(
            'verificado_por', 
            'nombre_verificador',
            'apellido_verificador',
            'email_verificador'
        );

        $router->render('asistencia/index', [
            'asistencia' => $asistencia
        ]);
    }
    public static function Crear(Router $router) {
    \verificarRol(rolesPermitidos: [1,2]); 
    $asistencia = new Asistencia();
    $id_practica = $_GET['id_practica'] ?? null;
    $practicaSeleccionada = null;
    if ($id_practica) {
        $practicas = Practica::listarPracticasActivas();
        $practicaSeleccionada = array_values(array_filter($practicas, fn($p) => $p['id_practica'] == $id_practica))[0] ?? null;
    }
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $datosAsistencia = [
            'id_practica' => $_POST['id_practica'] ?? null,
            'fecha' => $_POST['asistencia']['fecha'],
            'hora_ingreso' => $_POST['asistencia']['hora_ingreso'],
            'hora_salida' => $_POST['asistencia']['hora_salida'] ?: null,
            'verificado_por' => $practicaSeleccionada['id_supervisor'] ?? null, 
            'observacion' => $_POST['asistencia']['observacion'] ?? ''
        ];

        $asistencia = new Asistencia($datosAsistencia);
        $asistencia->crear();

        header('Location: /practica');
        exit;
    }
    $router->render('asistencia/crear', [
        'asistencia' => $asistencia,
        'practica' => $practicaSeleccionada
    ]);
    }
    public static function Historial(Router $router) {
            \verificarRol(rolesPermitidos: [1,2]); 

            if (!isset($_GET['id_practica']) || !isset($_GET['id_usuario'])) {
                header('Location: /practica');
                exit;
            }

            $id_practica = (int)$_GET['id_practica'];
            $id_usuario = (int)$_GET['id_usuario'];

            $historial = Asistencia::listarAsistencia($id_usuario);
            $historial = array_filter($historial, fn($a) => (int)$a['id_practica'] === $id_practica);

            $totalHoras = 0;

        foreach ($historial as $a) {
            if (!empty($a['hora_ingreso']) && !empty($a['hora_salida'])) {
                try {
                    $inicio = new \DateTime($a['hora_ingreso']);
                    $fin = new \DateTime($a['hora_salida']);
                    $diferencia = $fin->diff($inicio);
                    $horas = $diferencia->h + ($diferencia->i / 60);
                    $totalHoras += $horas;
                } catch (\Exception $e) {
                    continue;
                }
            }
        }
            Practica::actualizarHorasCumplidas($id_practica, $totalHoras);

            $router->render('asistencia/historial', [
                'historial' => $historial,
                'totalHoras' => $totalHoras
            ]);
    }
    public static function Editar(Router $router) {
        \verificarRol(rolesPermitidos: [1,2]); 

    $id_asistencia = $_GET['id_asistencia'] ?? null;
    if (!$id_asistencia) {
        header('Location: /asistencia');
        exit;
    }

    $asistencia = Asistencia::find($id_asistencia); 
    if (!$asistencia) {
        header('Location: /asistencia'); 
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $data = $_POST['asistencia'];
        $asistencia->sincronizar($data);
        $resultado = $asistencia->actualizar();

        if ($resultado) {
            header('Location: /asistencia');
            exit;
        }
    }

    $usuarios = Usuario::listarConRol();
    $usuariosFiltrados = array_filter($usuarios, fn($u) => strtolower($u['nombre_rol']) === 'empresa' || $u['id_rol'] == 2);

    $router->render('asistencia/editar', [
        'asistencia' => $asistencia,
        'usuario' => $usuariosFiltrados
    ]);
    }
    public static function Eliminar(Router $router) {
        \verificarRol(rolesPermitidos: [1,2]); 

    $id_asistencia = $_GET['id_asistencia'] ?? null;
    if (!$id_asistencia) {
        header('Location: /asistencia');
        exit;
    }

    $asistencia = Asistencia::find($id_asistencia);
    if (!$asistencia) {
        header('Location: /asistencia');
        exit;
    }

    try {
        $eliminado = $asistencia->eliminar();

        if ($eliminado) {
            $_SESSION['mensaje'] = "asistencia eliminada correctamente";
            header('Location: /asistencia');
            exit;
        } else {
            $_SESSION['error'] = "No se pudo eliminar la asistencia";
            header('Location: /asistencia');
            exit;
        }
    } catch (\Exception $e) {
        $_SESSION['error'] = "Error al eliminar lso otros: " . $e->getMessage();
        header('Location: /asistencia');
        exit;
    }
    }

}
?>
