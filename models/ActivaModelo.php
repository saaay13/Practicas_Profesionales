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
                     r.nombre_rol
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
            // 🔑 Convertir enums a string
            if ($value instanceof \UnitEnum) {
                $value = $value->value;
            }
            // si es null, guardamos NULL
            if ($value === null) {
                $resultado[$key] = "NULL";
            } else {
                $resultado[$key] = self::$db->escape_string((string)$value);
            }
        }
        return $resultado;
    }
    

    
    
    
}
?>