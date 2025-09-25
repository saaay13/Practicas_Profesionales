<?php
namespace Model;

class Egresado extends ActivaModelo {
    protected static $tabla = 'egresado';
    protected static $columnDB = [
        'id_egresado',
        'carrera',
        'anio_egreso'
    ];

    public $carrera;
    public $anio_egreso;

    public function __construct($args = []) {
        $this->carrera = $args['carrera'] ?? null;
        $this->anio_egreso = $args['anio_egreso'] ?? null;
    }
}
?>
