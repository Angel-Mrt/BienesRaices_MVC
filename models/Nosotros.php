<?php

namespace Model;

class Nosotros extends ActiveRecord
{
    protected static $tabla = 'nosotros';
    protected static $columnasDB = [
        'id', 'experiencia', 'contenido', 'imagen', 'seguridad', 'precio', 'tiempo'
    ];

    public $id;
    public $experiencia;
    public $contenido;
    public $imagen;
    public $seguridad;
    public $precio;
    public $tiempo;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->experiencia = $args['experiencia'] ?? '';
        $this->contenido = $args['contenido'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->seguridad = $args['seguridad'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->tiempo = $args['tiempo'] ?? '';
    }

    // Validacion

    public static function getErrores()
    {
        return self::$errores;
    }

    public function validar()
    {
        if (!$this->experiencia) {
            self::$errores[] = "Debe de agregar los años de experiencia";
        }
        if (!$this->contenido) {
            self::$errores[] = "Debes de agregar contenido";
        }
        if (!$this->imagen) {
            self::$errores[] = "Debes de agregar una Imagen";
        }

        if (!$this->seguridad) {
            self::$errores[] = "Debe de agregar los años de seguridad";
        }
        if (!$this->precio) {
            self::$errores[] = "Debes de agregar precio";
        }
        if (!$this->tiempo) {
            self::$errores[] = "Debes de agregar una tiempo";
        }

        return self::$errores;
    }
}
