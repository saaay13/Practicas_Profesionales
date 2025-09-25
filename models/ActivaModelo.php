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
        foreach($atributos as $key =>$value) 
        {
            $resultado[$key]=self::$db->escape_string($value);
        }
        return $resultado;
    }
    
    
    
    
}
?>