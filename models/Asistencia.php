<?php
namespace Model;

class Asistencia extends ActivaModelo {
    protected static $tabla = 'asistencia';
    protected static $columnDB = [
        'id_asistencia',
        'id_practica',
        'fecha',
        'hora_ingreso',
        'hora_salida',
        'verificado_por',
        'observacion'
    ];
    public $id_asistencia;
    public $id_practica;
    public $fecha;
    public $hora_ingreso;
    public $hora_salida;
    public $verificado_por;
    public $observacion;

    public function __construct($args = []) {
        $this->id_asistencia = $args['id_aistencia'] ?? null;
        $this->id_practica = $args['id_practica'] ?? null;
        $this->fecha = $args['fecha'] ?? null;
        $this->hora_ingreso = $args['hora_ingreso'] ?? null;
        $this->hora_salida = $args['hora_salida'] ?? null;
        $this->verificado_por = $args['verificado_por'] ?? null;
        $this->observacion = $args['observacion'] ?? '';
    }
}
?>
