<?php
namespace Model;

enum EstadoPractica: string {
    case EN_CURSO = 'en_curso';
    case FINALIZADA = 'finalizada';
    case CANCELADA = 'cancelada';
}

class Practica extends ActivaModelo {
    protected static $tabla = 'practica';
    protected static $columnDB = [
        'id_postulacion',
        'id_supervisor',
        'fecha_inicio',
        'fecha_fin',
        'horas_requeridas',
        'horas_cumplidas',
        'estado',
        'imagen'
        
    ];

    public $id_postulacion;
    public $id_supervisor;
    public $fecha_inicio;
    public $fecha_fin;
    public $horas_requeridas;
    public $horas_cumplidas;
    public EstadoPractica $estado;
    public $imagen;

    public function __construct($args = []) {
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
        $this->imagen = $args['imagen'] ?? null;
    }

    public function cambiarEstado(EstadoPractica $nuevoEstado): void {
        $this->estado = $nuevoEstado;
    }
}
