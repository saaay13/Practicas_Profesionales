<?php

namespace Model;

class Contacto extends ActivaModelo
{
    protected static $tabla = 'contacto';
    protected static $columnDB = ['id_contacto', 'id_usuario', 'correo', 'mensaje'];

    public $id_contacto;
    public $id_usuario;
    public $mensaje;

    public function __construct($args = [])
    {
        $this->id_contacto = $args['id_contacto'] ?? null;
        $this->id_usuario = $args['id_usuario'] ?? null;
        $this->mensaje = $args['mensaje'] ?? null;
    }
}
