<?php
namespace Model;

class Estudiante extends ActivaModelo {
    protected static $tabla = 'estudiante';
    protected static $columnDB = [
        'id_estudiante',
        'carrera',
        'semestre',
        'matricula'
    ];
    public $carrera;
    public $semestre;
    public $matricula;

    public function __construct($args = []) {
        $this->carrera = $args['carrera'] ?? null;
        $this->semestre = $args['semestre'] ?? null;
        $this->matricula = $args['matricula'] ?? null;
    }
   
}
?>
