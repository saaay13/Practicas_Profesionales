<?php
namespace Model;
require_once("../includes/app.php");
class ActivaModelo{
    //base de datos
    protected static $db;
    protected static $tabla;
    protected static $columnDB=[];
    public static function setDB($baseDatos){
        self::$db = conectarDB();
    }
    
    public static function listar(){
        $query = "Select * from ".static::$tabla;
        $resultado=self::$db->query($query);
        $producto=[];
        if($resultado){
            $producto=$resultado->fetch_all(MYSQLI_ASSOC); //convierte en array asociativo
        }
        return $producto;
    }
    public static function listarConUsuario() {
    $query = "SELECT t.*, u.nombre, u.apellido, u.email, u.telefono
              FROM " . static::$tabla . " t
              JOIN usuario u ON t.id_" . static::$tabla . " = u.id_usuario";
    $resultado = self::$db->query($query);
    $datos = [];
    if ($resultado) {
        $datos = $resultado->fetch_all(MYSQLI_ASSOC);
    }
    return $datos;
    }

    public static function listarConUsuarioGeneral($campoUsuario, $aliasNombre='nombre_usuario', 
    $aliasApellido = 'apellido_usuario', $aliasEmail ="email_usuario") {
        $query = "SELECT t.*, 
                        u.nombre AS $aliasNombre, 
                        u.apellido AS $aliasApellido,
                        u.email AS $aliasEmail
                FROM " . static::$tabla . " t
                LEFT JOIN usuario u ON t.$campoUsuario = u.id_usuario";
        $resultado = self::$db->query($query);
        $datos = [];
        if ($resultado) {
            $datos = $resultado->fetch_all(MYSQLI_ASSOC);
        }
        return $datos;
    }


public static function listarConRol() {
    $query = "SELECT u.id_usuario, u.nombre, u.apellido, u.email, u.telefono,
                     r.nombre_rol,u.id_rol
              FROM usuario u
              JOIN rol r ON u.id_rol = r.id_rol
              ORDER BY u.id_usuario ASC"; 
              
    $resultado = self::$db->query($query);
    $datos = [];
    if ($resultado) {
        $datos = $resultado->fetch_all(MYSQLI_ASSOC);
    }
    return $datos;
}

public static function listarConEmpresa() {
    $query = "SELECT c.id_convocatoria,
                     c.titulo,
                     c.descripcion,
                     c.requisitos,
                     c.fecha_publicacion,
                     c.fecha_cierre,
                     c.estado,
                     e.nombre_empresa
              FROM convocatoria c
              JOIN empresa e ON c.id_empresa = e.id_empresa
              ORDER BY c.id_convocatoria ASC";
    $resultado = self::$db->query($query);
    $datos = [];
    if ($resultado) {
        $datos = $resultado->fetch_all(MYSQLI_ASSOC);
    }
    return $datos;
}
     public function crear()
    {
       $atributos = $this->pasar();
    $query = " insert into ".static::$tabla." (";
    $query .= join(",", array_keys($atributos));
    $query .= ") values ('";
    $query .= join("','", array_values($atributos));
    $query .= "')";
    $resultado = self::$db->query($query);
    return $resultado;
    }
    public  function pasar ()//separa el key y value
    {
        $atributos=$this;
        $resultado=[];
        foreach ($this as $key => $value) {
        if ($value instanceof \UnitEnum) {
            $value = $value->value;
        }
        // Guardar NULL real en la base de datos
        if ($value === null || $value === '') {
            $resultado[$key] = null;
        } else {
            $resultado[$key] = self::$db->escape_string((string)$value);
        }
    }
    return $resultado;
    }
    
public static function listarAsistencia($id_usuario) {
    $id_usuario = (int)$id_usuario;

    $query = "SELECT a.*, 
                     p.id_postulacion, 
                     post.id_usuario,
                     u.nombre AS estudiante_nombre,
                     u.apellido AS estudiante_apellido,
                     s.nombre AS supervisor_nombre,
                     s.apellido AS supervisor_apellido
              FROM asistencia a
              JOIN practica p ON a.id_practica = p.id_practica
              JOIN postulacion post ON p.id_postulacion = post.id_postulacion
              JOIN usuario u ON post.id_usuario = u.id_usuario
              JOIN usuario s ON a.verificado_por = s.id_usuario
              WHERE u.id_usuario = $id_usuario
              ORDER BY a.fecha DESC";

    $resultado = self::$db->query($query);
    $datos = [];
    if($resultado){
        $datos = $resultado->fetch_all(MYSQLI_ASSOC);
    }
    return $datos;
}

    public static function listarPracticasActivas() {
    $query = "SELECT p.*, 
                     u.id_usuario AS id_estudiante, 
                     u.nombre AS estudiante_nombre, 
                     u.apellido AS estudiante_apellido,
                     s.id_usuario AS id_supervisor,
                     s.nombre AS supervisor_nombre,
                     s.apellido AS supervisor_apellido
              FROM practica p
              JOIN postulacion post ON p.id_postulacion = post.id_postulacion
              JOIN usuario u ON post.id_usuario = u.id_usuario
              LEFT JOIN usuario s ON p.id_supervisor = s.id_usuario
              WHERE post.estado = 'aceptada' AND p.estado = 'en_curso'";
    $resultado = self::$db->query($query);
    $datos = [];
    if ($resultado) {
        $datos = $resultado->fetch_all(MYSQLI_ASSOC);
    }
    return $datos;
}

    public static function actualizarEstadosGenerales() {
    $queryPracticas = "UPDATE " . static::$tabla . "
                       SET estado = 'finalizado'
                       WHERE estado = 'en_curso' AND horas_cumplidas >= 170";
    self::$db->query($queryPracticas);
    $queryConvocatorias = "SELECT id_convocatoria 
                           FROM convocatoria";
    $resultado = self::$db->query($queryConvocatorias);
    if ($resultado) {
        while ($conv = $resultado->fetch_assoc()) {
            $id_convocatoria = (int)$conv['id_convocatoria'];

            $queryPostulaciones = "SELECT COUNT(*) AS total,
                                          SUM(CASE WHEN estado = 'aceptada' THEN 1 ELSE 0 END) AS aceptadas
                                   FROM postulacion
                                   WHERE id_convocatoria = $id_convocatoria";
            $res = self::$db->query($queryPostulaciones);
            $datos = $res->fetch_assoc();
            if ($datos['total'] > 0 && $datos['total'] == $datos['aceptadas']) {
                $queryUpdate = "UPDATE convocatoria SET estado = 'cerrada' WHERE id_convocatoria = $id_convocatoria";
                self::$db->query($queryUpdate);
            }
        }
    }
}
public function editar() {
    $atributos = $this->pasar(); // reutiliza tu función para limpiar/escapar valores

    $campos = [];
    foreach ($atributos as $key => $value) {
        // Ignorar propiedades vacías o que no existan en la base de datos
        if ($key === 'id_' . static::$tabla) continue;

        if ($value === null) {
            $campos[] = "$key = NULL";
        } else {
            $campos[] = "$key = '$value'";
        }
    }

    if (!isset($this->{'id_' . static::$tabla})) {
        return false; // No se puede editar si no hay id
    }

    $id = (int)$this->{'id_' . static::$tabla};
    $query = "UPDATE " . static::$tabla . " SET " . join(", ", $campos) . " WHERE id_" . static::$tabla . " = $id";
    $resultado = self::$db->query($query);
    return $resultado;
}

public static function find($id) {
    $id = (int)$id;
    $query = "SELECT * FROM " . static::$tabla . " WHERE id_" . static::$tabla . " = $id LIMIT 1";
    $resultado = self::$db->query($query);

    if ($resultado && $resultado->num_rows > 0) {
        $datos = $resultado->fetch_assoc();

        // Intentamos convertir estado, si falla lo dejamos como string
        if (isset($datos['estado'])) {
            try {
                $datos['estado'] = \Model\EstadoPostulacion::from($datos['estado']);
            } catch (\ValueError $e) {
                // dejamos como string para no romper la carga
            }
        }

        return (new static())->sincronizar($datos);
    }

    return null;
}


public function sincronizar($datos = []) {
    foreach ($datos as $key => $value) {
        if (property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
        }
    }
}


    
}
?>