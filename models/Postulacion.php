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

public static function IndexPostulaciones($id_usuario) {
    $stmt = self::$db->prepare(
        "SELECT 
            p.id_postulacion,
            p.fecha_postulacion,
            p.mensaje_presentacion,
            p.estado AS estado_postulacion,
            u.id_usuario AS estudiante_id,
            u.nombre AS estudiante_nombre,
            u.apellido AS estudiante_apellido,
            c.id_convocatoria,
            c.titulo AS convocatoria_titulo,
            e.id_empresa,
            e.nombre_empresa
        FROM postulacion p
        JOIN convocatoria c ON p.id_convocatoria = c.id_convocatoria
        JOIN usuario u ON p.id_usuario = u.id_usuario
        JOIN empresa e ON c.id_empresa = e.id_empresa
        WHERE e.id_representante = ?
        ORDER BY p.fecha_postulacion DESC"
    );
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->fetch_all(MYSQLI_ASSOC);
}

public static function IndexPostulacion($id_usuario) {
    $stmt = self::$db->prepare(
        "SELECT 
            p.id_postulacion,
            p.fecha_postulacion,
            p.mensaje_presentacion,
            p.estado AS estado_postulacion,
            u.id_usuario AS estudiante_id,
            u.nombre AS estudiante_nombre,
            u.apellido AS estudiante_apellido,
            c.id_convocatoria,
            c.titulo AS convocatoria_titulo,
            e.id_empresa,
            e.nombre_empresa
        FROM postulacion p
        JOIN convocatoria c ON p.id_convocatoria = c.id_convocatoria
        JOIN usuario u ON p.id_usuario = u.id_usuario
        JOIN empresa e ON c.id_empresa = e.id_empresa
        WHERE p.id_usuario = ?
        ORDER BY p.fecha_postulacion DESC"
    );
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->fetch_all(MYSQLI_ASSOC);
}



}
