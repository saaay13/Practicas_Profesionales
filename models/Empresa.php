<?php
namespace Model;

class Empresa extends ActivaModelo {
    protected static $tabla = 'empresa';
    protected static $columnDB = [
        'id_empresa',
        'nombre_empresa',
        'nit',
        'rubro',
        'direccion',
        'id_representante',
        'cargo_representante',
        'verificada',
        'imagen'

    ];
    public $id_empresa;
    public $nombre_empresa;
    public $nit;
    public $rubro;
    public $direccion;
    public $id_representante;
    public $cargo_representante;
    public $verificada;
    public $imagen;

    public function __construct($args = []) {
        $this->id_empresa = $args['id_empresa'] ?? null;
        $this->nombre_empresa = $args['nombre_empresa'] ?? null;
        $this->nit = $args['nit'] ?? null;
        $this->rubro = $args['rubro'] ?? null;
        $this->direccion = $args['direccion'] ?? null;
        $this->id_representante = $args['id_representante'] ?? null;
        $this->cargo_representante = $args['cargo_representante'] ?? null;
        $this->verificada = $args['verificada'] ?? false;
        $this->imagen = $args['imagen'] ?? null;
    }
    public function setImagen ($imagen){
        {
            $this->imagen = $imagen;
        }

    }
 public static function listarMisEmpresas($id_usuario) {
    $id_usuario = (int)$id_usuario;

    $query = "SELECT e.*, 
                 u.nombre AS representante_nombre, 
                 u.apellido AS representante_apellido, 
                 u.email AS representante_email, 
                 u.telefono AS representante_telefono
          FROM empresa e
          LEFT JOIN usuario u ON e.id_representante = u.id_usuario
          WHERE e.id_representante = $id_usuario
          ORDER BY e.id_empresa DESC"; 


    $resultado = self::$db->query($query);
    $datos = [];
    if ($resultado) {
        $datos = $resultado->fetch_all(MYSQLI_ASSOC);
    }
    return $datos;
}


}
?>
