<?php
namespace Model;

enum EstadoConvocatoria: string {
    case ABIERTA = 'abierta';
    case CERRADA = 'cerrada';
    case CANCELADA = 'cancelada';
}

class Convocatoria extends ActivaModelo {
    protected static $tabla = 'convocatoria';
    protected static $columnDB = [
        'id_convocatoria',
        'id_empresa',
        'titulo',
        'descripcion',
        'requisitos',
        'fecha_publicacion',
        'fecha_cierre',
        'estado',
        'imagen'
    ];

    public $id_empresa;
    public $titulo;
    public $descripcion;
    public $requisitos;
    public $fecha_publicacion;
    public $fecha_cierre;
    public EstadoConvocatoria $estado;
    public $imagen ;
      public function __construct($args = []) {
        $this->id_empresa = $args['id_empresa'] ?? null;
        $this->titulo = $args['titulo'] ?? null;
        $this->descripcion = $args['descripcion'] ?? null;
        $this->requisitos = $args['requisitos'] ?? null;
        $this->fecha_publicacion = $args['fecha_publicacion'] ?? date("Y-m-d");
        $this->fecha_cierre = $args['fecha_cierre'] ?? null;

        // ✅ conversión segura de string a enum
        if (isset($args['estado'])) {
            if ($args['estado'] instanceof EstadoConvocatoria) {
                $this->estado = $args['estado']; // ya es enum
            } else {
                $this->estado = EstadoConvocatoria::tryFrom((string)$args['estado']) 
                    ?? EstadoConvocatoria::ABIERTA;
            }
        } else {
            $this->estado = EstadoConvocatoria::ABIERTA;
        }

        $this->imagen = $args['imagen'] ?? null;
    }


    public function cambiarEstado(EstadoConvocatoria $nuevoEstado) {
        $this->estado = $nuevoEstado;
    }
    public function setImagen ($imagen){
        {
            $this->imagen = $imagen;
        }

    }
}
?>
