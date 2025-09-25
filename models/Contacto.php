<?php

namespace Model;

class Contacto extends ActivaModelo
{
    protected static $tabla = 'contacto';
    protected static $columnDB = ['id_contacto', 'nombre', 'correo', 'mensaje'];

    public $id_contacto;
    public $nombre;
    public $correo;
    public $mensaje;

    public function __construct($args = [])
    {
        $this->id_contacto = $args['id_contacto'] ?? null;
        $this->nombre = $args['nombre'] ?? null;
        $this->correo = $args['correo'] ?? null;
        $this->mensaje = $args['mensaje'] ?? null;
    }
}
