<?php
namespace Model;

require_once("../includes/app.php");

class ActivaModelo {

    protected static $db;
    protected static $tabla;
    protected static $columnDB = [];

    public static function setDB($baseDatos) {
        self::$db = conectarDB();
    }

    public function __construct($args = []) {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function pasar() {
        $resultado = [];
        $excluir = ['autenticado'];

        foreach ($this as $key => $value) {
            if (in_array($key, $excluir)) continue;

            if ($value instanceof \BackedEnum) {
                $value = $value->value;
            } elseif ($value instanceof \UnitEnum) {
                $value = $value->name;
            }

            $resultado[$key] = ($value === null || $value === '') ? null : self::$db->escape_string((string)$value);
        }

        return $resultado;
    }

    public function crear() {
        $atributos = $this->pasar();
        $pk = static::$pk ?? 'id_' . static::$tabla;

        if (isset($atributos[$pk]) && empty($atributos[$pk])) {
            unset($atributos[$pk]);
        }

        $query = "INSERT INTO " . static::$tabla . " (" . join(",", array_keys($atributos)) . ") VALUES ('" . join("','", array_values($atributos)) . "')";
        $resultado = self::$db->query($query);

        if ($resultado && (!isset($this->$pk) || empty($this->$pk))) {
            $this->$pk = self::$db->insert_id;
        }

        return $resultado;
    }

    public function actualizar() {
        $pk = static::$pk ?? 'id_' . static::$tabla;
        if (!isset($this->$pk)) throw new \Exception("$pk no está definido");

        $atributos = $this->pasar();
        $valores = [];

        foreach ($atributos as $key => $value) {
            if ($key === $pk) continue;
            $valores[] = ($value === null) ? "$key = NULL" : "$key = '" . self::$db->escape_string((string)$value) . "'";
        }

        $query = "UPDATE " . static::$tabla . " SET " . join(", ", $valores) .
                 " WHERE $pk = '" . self::$db->escape_string((string)$this->$pk) . "' LIMIT 1";

        $resultado = self::$db->query($query);
        return $resultado && self::$db->affected_rows > 0;
    }

    public static function find($id) {
        $pk = static::$pk ?? 'id_' . static::$tabla;
        $query = "SELECT * FROM " . static::$tabla . " WHERE $pk = '" . self::$db->escape_string($id) . "' LIMIT 1";
        $resultado = self::$db->query($query);

        if ($resultado && $resultado->num_rows) {
            $registro = $resultado->fetch_assoc();
            $obj = new static($registro);
            $obj->$pk = $registro[$pk];
            return $obj;
        }

        return null;
    }

    public function eliminar() {
        $pk = static::$pk ?? 'id_' . static::$tabla;
        if (!isset($this->$pk)) throw new \Exception("No se puede eliminar: $pk no está definido");

        $id = self::$db->real_escape_string((string)$this->$pk);
        $query = "DELETE FROM " . static::$tabla . " WHERE $pk = '$id' LIMIT 1";

        $resultado = self::$db->query($query);
        if (!$resultado) throw new \Exception("Error MySQL: " . self::$db->error);

        return $resultado && self::$db->affected_rows > 0;
    }

    public function sincronizar($args = []) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key)) $this->$key = $value;
        }
    }

    // ----- LISTAR -----
    public static function listar() {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::$db->query($query);
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }

    public static function listarConUsuarioE() {
        $query = "SELECT t.*, u.nombre AS representante_nombre, u.apellido AS representante_apellido, 
                         u.email AS representante_email, u.telefono AS representante_telefono
                  FROM " . static::$tabla . " t
                  LEFT JOIN usuario u ON t.id_representante = u.id_usuario";

        $resultado = self::$db->query($query);
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }

    public static function listarConUsuario() {
        $fk = static::$fk_usuario ?? 'id_usuario';
        $query = "SELECT t.*, u.nombre AS usuario_nombre, u.apellido AS usuario_apellido, 
                         u.email AS usuario_email, u.telefono AS usuario_telefono
                  FROM " . static::$tabla . " t
                  LEFT JOIN usuario u ON t.$fk = u.id_usuario";

        $resultado = self::$db->query($query);
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }

    public static function listarConUsuarioGeneral($campoUsuario, $aliasNombre='nombre_usuario', $aliasApellido='apellido_usuario', $aliasEmail="email_usuario") {
        $query = "SELECT t.*, u.nombre AS $aliasNombre, u.apellido AS $aliasApellido, u.email AS $aliasEmail
                  FROM " . static::$tabla . " t
                  LEFT JOIN usuario u ON t.$campoUsuario = u.id_usuario";

        $resultado = self::$db->query($query);
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }

    public static function listarConRol() {
        $query = "SELECT u.id_usuario, u.nombre, u.apellido, u.email, u.telefono, r.nombre_rol, u.id_rol
                  FROM usuario u
                  JOIN rol r ON u.id_rol = r.id_rol
                  ORDER BY u.id_usuario ASC";

        $resultado = self::$db->query($query);
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }

    public static function listarConEmpresa() {
        $query = "SELECT c.id_convocatoria, c.titulo, c.descripcion, c.requisitos, c.fecha_publicacion, c.fecha_cierre, c.estado, c.imagen, e.nombre_empresa
                  FROM convocatoria c
                  JOIN empresa e ON c.id_empresa = e.id_empresa
                  ORDER BY c.id_convocatoria ASC";

        $resultado = self::$db->query($query);
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }

   
    public static function listarPracticasActivas() {
        $query = "SELECT p.*, u.id_usuario AS id_estudiante, u.nombre AS estudiante_nombre, u.apellido AS estudiante_apellido,
                         s.id_usuario AS id_supervisor, s.nombre AS supervisor_nombre, s.apellido AS supervisor_apellido
                  FROM practica p
                  JOIN postulacion post ON p.id_postulacion = post.id_postulacion
                  JOIN usuario u ON post.id_usuario = u.id_usuario
                  LEFT JOIN usuario s ON p.id_supervisor = s.id_usuario
                  WHERE post.estado = 'aceptada' AND p.estado = 'en_curso'";

        $resultado = self::$db->query($query);
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }

    // ----- FUNCIONES ESPECÍFICAS -----
    public static function actualizarEstadosConvocatoria($id_postulacion) {
        $id_postulacion = (int)$id_postulacion;
        $queryConv = "SELECT id_convocatoria FROM postulacion WHERE id_postulacion = $id_postulacion";
        $resConv = self::$db->query($queryConv);

        if ($resConv && $resConv->num_rows > 0) {
            $id_convocatoria = (int)$resConv->fetch_assoc()['id_convocatoria'];
            $queryCheck = "SELECT COUNT(*) AS aceptadas FROM postulacion WHERE id_convocatoria = $id_convocatoria AND estado = 'aceptada'";
            $resCheck = self::$db->query($queryCheck);
            $datos = $resCheck->fetch_assoc();

            if ($datos['aceptadas'] > 0) {
                self::$db->query("UPDATE convocatoria SET estado = 'cerrada' WHERE id_convocatoria = $id_convocatoria");
                self::$db->query("UPDATE postulacion SET estado = 'rechazada' WHERE id_convocatoria = $id_convocatoria AND estado != 'aceptada'");
            } else {
                self::$db->query("UPDATE convocatoria SET estado = 'abierta' WHERE id_convocatoria = $id_convocatoria");
            }
        }
    }

    public static function obtenerEncargado($id_postulacion) {
        $id_postulacion = (int)$id_postulacion;
        $query = "SELECT e.id_representante
                  FROM postulacion p
                  JOIN convocatoria c ON p.id_convocatoria = c.id_convocatoria
                  JOIN empresa e ON c.id_empresa = e.id_empresa
                  WHERE p.id_postulacion = $id_postulacion
                  LIMIT 1";

        $resultado = self::$db->query($query);
        return ($resultado && $resultado->num_rows > 0) ? (int)$resultado->fetch_assoc()['id_representante'] : null;
    }
}
?>
