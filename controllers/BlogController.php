<?php

namespace Controllers;

use MVC\Router;
use Model\Blog;
use Intervention\Image\ImageManagerStatic as Image;

class BlogController
{
    public static function index(Router $router)
    {
        $blog = Blog::all();
        // Muestra Mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('blog/admin', [
            'resultado' => $resultado,
            'blog' => $blog
        ]);
    }

    public static function crear(Router $router)
    {
        $blog = new Blog;

        //arreglo con mensajes de errores
        $errores = Blog::getErrores();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Crea una nueva instancia
            $blog = new Blog($_POST['blog']);
            //Generar un Nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            // Setear la imagen
            // Realiza un resize a la imagen con Intervetion
            if ($_FILES['blog']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['blog']['tmp_name']['imagen'])->fit(800, 600);
                $blog->setImagen($nombreImagen);
            }

            // Validar 
            $errores = $blog->validar();

            if (empty($errores)) {

                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
                // Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES .  $nombreImagen);

                // Guarda en la base de datos
                $blog->guardar();

                // Mensaje de Exito o Error
            }
        }

        $router->render('blog/crear', [
            'blog' => $blog,
            'errores' => $errores
        ]);
    }
    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar('/blog/admin');
        $blog = Blog::find($id);
        //arreglo con mensajes de errores
        $errores = blog::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los atributos
            $args = $_POST['blog'];
            $blog->sincronizar($args);
            //Validacion 
            $errores = $blog->validar();
            // SUbida de Archivos
            //Generar un Nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            // Setear la imagen
            // Realiza un resize a la imagen con Intervetion
            if ($_FILES['blog']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['blog']['tmp_name']['imagen'])->fit(800, 600);
                $blog->setImagen($nombreImagen);
            }
            if (empty($errores)) {

                if ($_FILES['blog']['tmp_name']['imagen']) {
                    // Almacenar la imagen
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $blog->guardar();
            }
        }

        $router->render('blog/actualizar', [
            'blog' => $blog,
            'errores' => $errores
        ]);
    }
    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar Id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {

                $tipo = $_POST['tipo'];

                if (validarTipoContenido($tipo)) {
                    $blog = Blog::find($id);
                    $blog->eliminar();
                }
            }
        }
    }
}
