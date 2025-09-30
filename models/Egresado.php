<?php
namespace Model;

class Egresado extends ActivaModelo {
    protected static $tabla = 'egresado';
    protected static $fk_usuario = 'id_egresado';


    protected static $columnDB = [
        'id_egresado',
        'carrera',
        'anio_egreso'
    ];
    public $id_egresado;

    public $carrera;
    public $anio_egreso;

    public function __construct($args = []) {
        $this->id_egresado=$args['id_egresado']?? null;
        $this->carrera = $args['carrera'] ?? null;
        $this->anio_egreso = $args['anio_egreso'] ?? null;
    }
}
?>
