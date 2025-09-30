<?php
namespace Model;

enum EstadoPostulacion: string {
    case EN_REVISION = 'en_revision';
    case ACEPTADA = 'aceptada';
    case RECHAZADA = 'rechazada';
    case FINALIZADA = 'finalizada';
}

class Postulacion extends ActivaModelo {
    protected static $tabla = 'postulacion';
    protected static $pk = 'id_postulacion';
    protected static $columnDB = [
        'id_convocatoria',
        'id_usuario',
        'fecha_postulacion',
        'estado',
        'mensaje_presentacion'
    ];
    public $id_postulacion;
    public $id_convocatoria;
    public $id_usuario;
    public $fecha_postulacion;
    public EstadoPostulacion $estado;
    public $mensaje_presentacion;

    public function __construct($args = []) {
        $this->id_postulacion = $args['id_postulacion'] ?? null;
        $this->id_convocatoria = $args['id_convocatoria'] ?? null;
        $this->id_usuario = $args['id_usuario'] ?? null;
        $this->fecha_postulacion = $args['fecha_postulacion'] ?? date("Y-m-d");
        $this->mensaje_presentacion = $args['mensaje_presentacion'] ?? null;

        if (isset($args['estado']) && $args['estado'] instanceof EstadoPostulacion) {
            $this->estado = $args['estado'];
        } elseif (isset($args['estado'])) {
            $this->estado = EstadoPostulacion::from($args['estado']);
        } else {
            $this->estado = EstadoPostulacion::EN_REVISION;
        }
    }
public static function listarAceptadas() {
    $query = "SELECT p.id_postulacion, p.id_usuario, u.nombre, u.apellido
              FROM " . static::$tabla . " p
              JOIN usuario u ON p.id_usuario = u.id_usuario
              WHERE p.estado = 'aceptada'";
    
    $resultado = self::$db->query($query);
    $datos = [];
    if ($resultado) {
        $datos = $resultado->fetch_all(MYSQLI_ASSOC);
    }
    return $datos;
}

   

}
