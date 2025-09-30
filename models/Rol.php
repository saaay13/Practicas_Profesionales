<?php
namespace Model;

class Rol extends ActivaModelo{
    protected static $tabla = 'rol';
    protected static $columnDB = ['id_rol','nombre_rol'];
    public $id_rol;
public $nombre_rol;

public function __construct($args=[]){
    $this->id_rol = $args['id_rol']?? null;
    $this->nombre_rol = $args['nombre_rol']??null;
}
}

?>