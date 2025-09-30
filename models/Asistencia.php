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
     public static function listarAsistencia($id_usuario) {
        $id_usuario = (int)$id_usuario;
        $query = "SELECT a.*, p.id_postulacion, post.id_usuario,
                         u.nombre AS estudiante_nombre, u.apellido AS estudiante_apellido,
                         s.nombre AS supervisor_nombre, s.apellido AS supervisor_apellido
                  FROM asistencia a
                  JOIN practica p ON a.id_practica = p.id_practica
                  JOIN postulacion post ON p.id_postulacion = post.id_postulacion
                  JOIN usuario u ON post.id_usuario = u.id_usuario
                  JOIN usuario s ON a.verificado_por = s.id_usuario
                  WHERE u.id_usuario = $id_usuario
                  ORDER BY a.fecha DESC";

        $resultado = self::$db->query($query);
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }

}
?>
