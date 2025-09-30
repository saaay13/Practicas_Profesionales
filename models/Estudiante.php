<?php
namespace Model;

class Estudiante extends ActivaModelo {
    protected static $tabla = 'estudiante';
        protected static $fk_usuario = 'id_estudiante';
        protected static $pk = 'id_estudiante';
    protected static $columnDB = [
        'id_estudiante',
        'carrera',
        'semestre',
        'matricula'
    ];
    public $id_estudiante;
    public $carrera;
    public $semestre;
    public $matricula;

    public function __construct($args = []) {
        $this->id_estudiante = $args['id_estudiante']?? null;
        $this->carrera = $args['carrera'] ?? null;
        $this->semestre = $args['semestre'] ?? null;
        $this->matricula = $args['matricula'] ?? null;
    }
   
}
?>
