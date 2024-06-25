<?php

namespace Model;

class Blog extends ActiveRecord
{

    protected static $tabla = 'blog';
    protected static $columnasDB = [
        'id', 'titulo', 'autor', 'descripcion', 'contenido',
        'imagen', 'fecha'
    ];

    public $id;
    public $titulo;
    public $autor;
    public $descripcion;
    public $contenido;
    public $imagen;
    public $fecha;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->autor = $args['autor'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->contenido = $args['contenido'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->fecha = date('Y-m-d H:i:s');
    }

    // Validacion
    public static function getErrores()
    {
        return self::$errores;
    }

    public function validar()
    {

        if (!$this->titulo) {
            self::$errores[] = "Debes de añadir un titulo";
        }

        if (!$this->autor) {
            self::$errores[] = "El autor es Obligatorio";
        }

        if (strlen($this->descripcion) < 50) {
            self::$errores[] = "La Descripcion es obligatoria y debe de tener al menos 50 caracteres";
        }
        if (strlen($this->contenido) < 150) {
            self::$errores[] = "El contenido es obligatoria y debe de tener mas de 150 caracteres";
        }

        if (!$this->imagen) {
            self::$errores[] = "La Imagen es Obligatoria";
        }

        return self::$errores;
    }
}
