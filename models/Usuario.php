<?php
namespace Model;

class Usuario extends ActivaModelo {
    protected static $tabla = 'usuario';
    protected static $columnDB = ['id_usuario','nombre','apellido','email','password','telefono','fecha_registro','id_rol'];
    public $id_usuario;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $fecha_registro;
    public $id_rol;
    public $autenticado=false;
    protected static $errores=[];

    public function __construct($args = [],$hashPassword = true) {
        $this->nombre = $args['nombre'] ?? null;
        $this->apellido = $args['apellido'] ?? null;
        $this->email = $args['email'] ?? null;
        $this->password = $args['password'] ?? null; 
        $this->telefono = $args['telefono'] ?? null;
        $this->id_rol = $args['id_rol'] ?? null;
        $this->fecha_registro = $args['fecha_registro'] ?? date("Y-m-d H:i:s");
        
    if ($hashPassword && !empty($args['password'])) {
        $this->password = password_hash($args['password'], PASSWORD_DEFAULT);
    }
    }
    public function validar(){
        if(!$this->email){
            self::$errores[] = 'El email del usuario es obligatorio';
        }
        if(!$this->password){
            self::$errores[] = 'El password del usuario es obligatorio';
        }
        return self::$errores;
    }
    public function existeUsuario()
    {
        $query = "Select * from ".self::$tabla." Where email = '" . $this->email . "' Limit 1";
        $resultado = self::$db->query($query);
        if(!$resultado->num_rows)
        {
            self::$errores[]="El Usuario no existe";
            
            return;
        }
        return $resultado;
    }
    public function comprobarPassword($resultado): bool
{
    $usuario = $resultado->fetch_object();

    if (!$usuario || !isset($usuario->password)) {
        self::$errores[] = "Usuario inválido o sin contraseña";
        return false;
    }

    // Verificamos el password usando password_verify
    if (password_verify($this->password, $usuario->password)) {
        $this->autenticado = true;

        // cargamos datos del usuario en el objeto
        $this->id_usuario = $usuario->id_usuario;
        $this->nombre     = $usuario->nombre;
        $this->apellido   = $usuario->apellido;
        $this->id_rol     = $usuario->id_rol;

    } else {
        self::$errores[] = "El password es incorrecto";
    }

    return $this->autenticado;
}

    public function autenticar()
    {
        session_start();
        $_SESSION['usuario']=$this->email;
        $_SESSION['login']=true;
        $_SESSION['id_usuario']=$this->id_usuario;
        $_SESSION['rol'] = $this->id_rol;
        $_SESSION['nombre'] = $this->nombre; 
        header('Location: /');
        exit;
    }
    public static function getErrores()
    {
        return static::$errores;
    }
}
/*
$2y$10$B0g/dQVc2O1Kp0SY9jNJp.7hq3AC7txdSt7mdzzLfWVCnpfKvL5oK
$2y$10$0uEArkgL3GzDjK5bU5yijeO9k.Y5Or/ufiugpdczDdSBDATtJTqVK

*/