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
        'representante',
        'cargo_representante',
        'verificada',
        'imagen'

    ];

    public $nombre_empresa;
    public $nit;
    public $rubro;
    public $direccion;
    public $representante;
    public $cargo_representante;
    public $verificada;
    public $imagen;

    public function __construct($args = []) {
        $this->nombre_empresa = $args['nombre_empresa'] ?? null;
        $this->nit = $args['nit'] ?? null;
        $this->rubro = $args['rubro'] ?? null;
        $this->direccion = $args['direccion'] ?? null;
        $this->representante = $args['representante'] ?? null;
        $this->cargo_representante = $args['cargo_representante'] ?? null;
        $this->verificada = $args['verificada'] ?? false;
        $this->imagen = $args['imagen'] ?? null;

    }
}
?>
