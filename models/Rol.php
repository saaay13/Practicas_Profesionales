<?php
namespace Model;

class Rol extends ActivaModelo{
    protected static $tabla = 'rol';
    protected static $columnDB = ['id_rol','nombre_rol'];
public $nombre_rol;

public function __construct($args=[]){
    $this->nombre_rol = $args['nombre_rol']??null;
}
}

?>