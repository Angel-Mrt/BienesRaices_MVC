<?php

namespace Model;

class Vendedor extends ActiveRecord
{
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono', 'imagen'];
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $imagen;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
    }

    public function validar()
    {

        if (!$this->nombre) {
            self::$errores[] = "El Nombre es Obligatorio";
        }
        if (!$this->apellido) {
            self::$errores[] = "El Apellido es Obligatorio";
        }
        if (!$this->telefono) {
            self::$errores[] = "El Telefono es Obligatorio";
        }
        if (!preg_match('/[0-9]{10}/', $this->telefono)) {
            self::$errores[] = "Formato de Tel. No Valido";
        }
        if (!$this->imagen) {
            self::$errores[] = "La Imagen es Obligatoria";
        }

        return self::$errores;
    }
}
