<?php
namespace Model;

enum EstadoPractica: string {
    case EN_CURSO = 'en_curso';
    case FINALIZADA = 'finalizada';
    case CANCELADA = 'cancelada';
}

class Practica extends ActivaModelo {
    protected static $tabla = 'practica';
    protected static $pk = 'id_practica';
    protected static $columnDB = [
        'id_practica',
        'id_postulacion',
        'id_supervisor',
        'fecha_inicio',
        'fecha_fin',
        'horas_requeridas',
        'horas_cumplidas',
        'estado',
        'imagen'
        
    ];

    public $id_practica ;
    public $id_postulacion;
    public $id_supervisor;
    public $fecha_inicio;
    public $fecha_fin;
    public $horas_requeridas;
    public $horas_cumplidas;
    public EstadoPractica $estado;

    public function __construct($args = []) {
        $this->id_practica = $args['id_practica'] ?? null;
        $this->id_postulacion = $args['id_postulacion'] ?? null;
        $this->id_supervisor = $args['id_supervisor'] ?? null;
        $this->fecha_inicio = $args['fecha_inicio'] ?? null;
        $this->fecha_fin = $args['fecha_fin'] ?? null;
        $this->horas_requeridas = $args['horas_requeridas'] ?? 170;
        $this->horas_cumplidas = $args['horas_cumplidas'] ?? 0;

        if (isset($args['estado']) && $args['estado'] instanceof EstadoPractica) {
            $this->estado = $args['estado'];
        } elseif (isset($args['estado'])) {
            $this->estado = EstadoPractica::from($args['estado']);
        } else {
            $this->estado = EstadoPractica::EN_CURSO;
        }
    }

    public static function actualizarEstadoFinalizado($id_practica = null) {
    $query = "UPDATE practica 
              SET estado = 'finalizado'
              WHERE estado = 'en_curso' AND horas_cumplidas >= 170";

    if ($id_practica) {
        $id_practica = (int)$id_practica;
        $query .= " AND id_practica = $id_practica";
    }

    self::$db->query($query);
}

public static function actualizarHorasCumplidas($id_practica, $totalHoras) {
    $id_practica = (int)$id_practica;
    $totalHoras = (float)$totalHoras;
    $query = "UPDATE practica SET horas_cumplidas = $totalHoras WHERE id_practica = $id_practica";
    self::$db->query($query);
}


}
