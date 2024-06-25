<?php

namespace Model;

use mysqli_sql_exception;

class ActiveRecord
{
    //Base de Datos

    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';
    //Errores 
    protected static $errores = [];


    // Definir la conexion a la bd
    public static function setDB($database)
    {
        self::$db = $database;
    }



    public function guardar()
    {
        if (!is_null($this->id)) {
            // Actualizar
            $this->actualizar();
        } else {
            // Creando un nuevo registro
            $this->crear();
        }
    }
    public function crear()
    {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // $string = join("', '", array_values($atributos));
        // debuguear($string);

        //insertar en la base de datos
        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ')";

        $resultado = self::$db->query($query);
        if ($resultado) {
            //Redireccionar al usuario
            header('Location: ../../admin?resultado=1');
        }
    }

    public function actualizar()
    {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id ='" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1";

        $resultado = self::$db->query($query);

        if ($resultado) {
            //Redireccionar al usuario

            header('Location: ../../admin?resultado=2');
        }
    }

    // Eliminar un registro

    public function eliminar()
    {
        try {
            // Intentar ejecutar la consulta de eliminación
            $query = "DELETE FROM " . static::$tabla . " WHERE id=" . self::$db->escape_string($this->id) . " LIMIT 1";
            $resultado = self::$db->query($query);

            // Si la consulta se ejecuta correctamente
            if ($resultado) {
                // Eliminar la imagen del vendedor
                $this->borrarImagen();
                // Redirigir a la página de administración con resultado exitoso
                header('location: ../admin?resultado=3');
            } else {
                // Si hay un error al ejecutar la consulta, redirigir con mensaje de error
                header('location: ../admin?resultado=4');
            }
        } catch (mysqli_sql_exception $ex) {
            // Manejar la excepción (por ejemplo, mostrar un mensaje de error al usuario)
            // echo "Error al eliminar el vendedor: " . $ex->getMessage();
            header('location: ../admin?resultado=4');
        }
    }


    // Identificar y unir los atributos de la BD
    public function atributos()
    {
        $atributos = [];

        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    // Subida de Archivos
    public function setImagen($imagen)
    {
        // Elimina la Imagen Previa
        if (!is_null($this->id)) {
            // Comprobar si existe el archivo 
            $this->borrarImagen();
        }
        // Asignar al atributo de imagen el nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    //** Elimina archivo */

    // public function borrarImagen()
    // {
    //     // Elimina la Imagen Previa
    //     // Comprobar si existe el archivo 
    //     $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
    //     if ($existeArchivo) {
    //         unlink(CARPETA_IMAGENES . $this->imagen);
    //     }
    // }
    public function borrarImagen()
    {
        // Elimina la Imagen Previa
        if (!empty($this->imagen)) {
            // Comprobar si existe el archivo 
            $rutaImagen = CARPETA_IMAGENES . $this->imagen;
            if (file_exists($rutaImagen)) {
                unlink($rutaImagen);
            }
        }
    }

    // Validacion
    public static function getErrores()
    {
        return static::$errores;
    }

    public function validar()
    {
        static::$errores = [];
        return static::$errores;
    }

    // Lista todas los registros
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    // Obtiene un numero determinado de registros
    public static function get($cantidad)
    {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }


    // Busca un registro por su ID
    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id= {$id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }



    public static function consultarSQL($query)
    {
        // Consultar la BD
        $resultado = self::$db->query($query);
        // Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }
        // Liberar la memoria

        $resultado->free();

        // Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro)
    {
        $objeto = new static;
        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
