<?php
namespace Model;

class Usuario extends ActivaModelo {
    protected static $tabla = 'usuario';
    protected static $columnDB = ['id_usuario','nombre','apellido','email','password','telefono','fecha_registro','id_rol'];

    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $fecha_registro;
    public $id_rol;

    public function __construct($args = []) {
        $this->nombre = $args['nombre'] ?? null;
        $this->apellido = $args['apellido'] ?? null;
        $this->email = $args['email'] ?? null;
        $this->password = $args['password'] ?? null; 
        $this->telefono = $args['telefono'] ?? null;
        $this->id_rol = $args['id_rol'] ?? null;
        $this->fecha_registro = $args['fecha_registro'] ?? date("Y-m-d H:i:s");
        if (!empty($args['password'])) {
        $this->password = password_hash($args['password'], PASSWORD_DEFAULT);
    }
    }
}
