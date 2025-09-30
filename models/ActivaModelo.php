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
    
    public function __construct($args = []) {
    foreach ($args as $key => $value) {
        if (property_exists($this, $key)) {
            $this->$key = $value;
        }
    }
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
    public static function listarConUsuarioE() {
    $query = "SELECT t.*, u.nombre AS representante_nombre, u.apellido AS representante_apellido, 
                     u.email AS representante_email, u.telefono AS representante_telefono
              FROM " . static::$tabla . " t
              LEFT JOIN usuario u ON t.id_representante = u.id_usuario";
    $resultado = self::$db->query($query);
    $datos = [];
    if ($resultado) {
        $datos = $resultado->fetch_all(MYSQLI_ASSOC);
    }
    return $datos;

}
public static function listarConUsuario() {
    $fk = static::$fk_usuario ?? 'id_usuario'; // cada clase define $fk_usuario
    $query = "SELECT t.*, 
                     u.nombre AS usuario_nombre, 
                     u.apellido AS usuario_apellido, 
                     u.email AS usuario_email, 
                     u.telefono AS usuario_telefono
              FROM " . static::$tabla . " t
              LEFT JOIN usuario u ON t.$fk = u.id_usuario";

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
                     c.imagen,
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

   public function crear() {
    $atributos = $this->pasar();
    $pk = static::$pk ?? 'id_' . static::$tabla;
    if (isset($atributos[$pk]) && empty($atributos[$pk])) {
        unset($atributos[$pk]);
    }

    $query = "INSERT INTO " . static::$tabla . " (";
    $query .= join(",", array_keys($atributos));
    $query .= ") VALUES ('";
    $query .= join("','", array_values($atributos));
    $query .= "')";
    
    $resultado = self::$db->query($query);
    if ($resultado) {
        if (!isset($this->$pk) || empty($this->$pk)) {
            $this->$pk = self::$db->insert_id;
        }
    }

    return $resultado;
}

public function pasar() {
    $resultado = [];
    $excluir = ['autenticado']; // <- aquí puedes añadir otras propiedades que no estén en la DB

    foreach ($this as $key => $value) {
        if (in_array($key, $excluir)) continue;

        if ($value instanceof \BackedEnum) {
            $value = $value->value;
        } elseif ($value instanceof \UnitEnum) {
            $value = $value->name;
        }

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

public static function actualizarConvocatoriaYRechazarOtras($id_postulacion) {
    $id_postulacion = (int)$id_postulacion;

    // Obtener la convocatoria asociada
    $queryConv = "SELECT id_convocatoria FROM postulacion WHERE id_postulacion = $id_postulacion";
    $resConv = self::$db->query($queryConv);

    if ($resConv && $resConv->num_rows > 0) {
        $id_convocatoria = (int)$resConv->fetch_assoc()['id_convocatoria'];

        // Verificar si hay al menos una postulacion aceptada
        $queryCheck = "SELECT COUNT(*) AS aceptadas
                       FROM postulacion
                       WHERE id_convocatoria = $id_convocatoria
                         AND estado = 'aceptada'";

        $resCheck = self::$db->query($queryCheck);
        $datos = $resCheck->fetch_assoc();

        if ($datos['aceptadas'] > 0) {
            // Cierra la convocatoria
            $queryUpdate = "UPDATE convocatoria SET estado = 'cerrada' WHERE id_convocatoria = $id_convocatoria";
            self::$db->query($queryUpdate);

            // Rechaza las demás postulaciones que no fueron aceptadas
            $queryRechazar = "UPDATE postulacion 
                              SET estado = 'rechazada' 
                              WHERE id_convocatoria = $id_convocatoria 
                                AND estado != 'aceptada'";
            self::$db->query($queryRechazar);

        } else {
            // Si no hay aceptadas, la convocatoria sigue abierta
            $queryUpdate = "UPDATE convocatoria SET estado = 'abierta' WHERE id_convocatoria = $id_convocatoria";
            self::$db->query($queryUpdate);
        }
    }
}


public function actualizar() {
    $pk = static::$pk ?? 'id_' . static::$tabla;
    if (!isset($this->$pk)) {
        throw new \Exception("$pk no está definido");
    }

    $atributos = $this->pasar();
    $valores = [];

    foreach ($atributos as $key => $value) {
        if ($key === $pk) continue;
        if ($value === null) {
            $valores[] = "$key = NULL";
        } else {
            $valores[] = "$key = '" . self::$db->escape_string((string)$value) . "'";
        }
    }

    $query = "UPDATE " . static::$tabla . " SET " . join(", ", $valores);
    $query .= " WHERE $pk = '" . self::$db->escape_string((string)$this->$pk) . "' LIMIT 1";

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
public static function obtenerEncargado($id_postulacion) {
    $id_postulacion = (int)$id_postulacion;

    $query = "SELECT e.id_representante
              FROM postulacion p
              JOIN convocatoria c ON p.id_convocatoria = c.id_convocatoria
              JOIN empresa e ON c.id_empresa = e.id_empresa
              WHERE p.id_postulacion = $id_postulacion
              LIMIT 1";

    $resultado = self::$db->query($query);
    if ($resultado && $resultado->num_rows > 0) {
        return (int)$resultado->fetch_assoc()['id_representante'];
    }
    return null;
}



public function sincronizar($args = []) {
    foreach($args as $key => $value) {
        if(property_exists($this, $key)) {
            $this->$key = $value;
        }
    }
}

public function eliminar() {
    $pk = static::$pk ?? 'id_' . static::$tabla;

    if (!isset($this->$pk)) {
        throw new \Exception("No se puede eliminar: $pk no está definido");
    }

    $id = self::$db->real_escape_string((string)$this->$pk);
    $query = "DELETE FROM " . static::$tabla . " WHERE $pk = '$id' LIMIT 1";

    $resultado = self::$db->query($query);

    if (!$resultado) {
        throw new \Exception("Error MySQL: " . self::$db->error);
    }

    return $resultado && self::$db->affected_rows > 0;
}
public function eliminarEnCascada() {
    $pk = static::$pk ?? 'id_' . static::$tabla;

    if (!isset($this->$pk)) {
        echo "Error: clave primaria $pk no definida";
        return false;
    }

    $id = self::$db->real_escape_string((string)$this->$pk);

    // Tablas hijas
    if (!empty(static::$tablas_hijas)) {
        foreach (static::$tablas_hijas as $tabla => $columna) {
            // Mostrar qué tabla y columna se va a borrar
            echo "Intentando borrar de $tabla donde $columna = $id<br>";

            $query_check = "SHOW TABLES LIKE '$tabla'";
            $res_check = self::$db->query($query_check);
            if ($res_check && $res_check->num_rows > 0) {
                $query = "DELETE FROM `$tabla` WHERE `$columna` = '$id'";
                echo "Consulta: $query<br>";
                if (!self::$db->query($query)) {
                    echo "Error MySQL en tabla $tabla: " . self::$db->error . "<br>";
                } else {
                    echo "Filas eliminadas en $tabla: " . self::$db->affected_rows . "<br>";
                }
            } else {
                echo "Tabla $tabla no existe<br>";
            }
        }
    }

    // Eliminar el registro principal
    $query = "DELETE FROM `" . static::$tabla . "` WHERE `$pk` = '$id' LIMIT 1";
    echo "Eliminando usuario con consulta: $query<br>";

    $resultado = self::$db->query($query);

    if (!$resultado) {
        echo "Error MySQL al eliminar usuario: " . self::$db->error . "<br>";
        return false;
    }

    echo "Usuario eliminado: " . self::$db->affected_rows . " fila(s)<br>";
    return $resultado && self::$db->affected_rows > 0;
}


    
}
?>