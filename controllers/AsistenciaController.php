<?php
namespace Controllers;

use Model\Asistencia; 
use Model\Practica;
use Model\Usuario;
use MVC\Router;

class AsistenciaController {

    public static function Index(Router $router){   
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
            'verificado_por' => $practicaSeleccionada['id_supervisor'] ?? null, // supervisor de la práctica
            'observacion' => $_POST['asistencia']['observacion'] ?? ''
        ];

        $asistencia = new Asistencia($datosAsistencia);
        $asistencia->crear();

        header('Location: /practica');
        exit;
    }

    // Solo necesitamos la práctica y el supervisor
    $router->render('asistencia/crear', [
        'asistencia' => $asistencia,
        'practica' => $practicaSeleccionada
    ]);
}


public static function Historial(Router $router) {
    if (!isset($_GET['id_practica']) || !isset($_GET['id_usuario'])) {
        header('Location: /practica');
        exit;
    }

    $id_practica = (int)$_GET['id_practica'];
    $id_usuario = (int)$_GET['id_usuario'];

    $historial = Asistencia::listarAsistencia($id_usuario);
    $historial = array_filter($historial, fn($a) => (int)$a['id_practica'] === $id_practica);

    // Calcular horas cumplidas totales
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
            // Si hay error en formato de hora, lo ignoramos
            continue;
        }
    }
}


    // Actualizar horas_cumplidas en la práctica
    Practica::actualizarHorasCumplidas($id_practica, $totalHoras);

    $router->render('asistencia/historial', [
        'historial' => $historial,
        'totalHoras' => $totalHoras
    ]);
}


}
?>
