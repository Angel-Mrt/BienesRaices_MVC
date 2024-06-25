<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class VendedorController
{
    public static function crear(Router $router)
    {
        $vendedor = new Vendedor();
        //arreglo con mensajes de errores
        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Crear un nueva Instancia
            $vendedor = new Vendedor($_POST['vendedor']);

            //Generar un Nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Setear la imagen
            // Realiza un resize a la imagen con Intervetion
            if ($_FILES['vendedor']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800, 600);
                $vendedor->setImagen($nombreImagen);
            }
            //Validar que no haya campos vacios
            $errores = $vendedor->validar();

            // No hay errores
            if (empty($errores)) {
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
                // Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES .  $nombreImagen);

                $vendedor->guardar();
            }
        }

        $router->render('vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores


        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar('/admin');
        $vendedor = Vendedor::find($id);
        //arreglo con mensajes de errores
        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los valores
            $args = $_POST['vendedor'];
            // SIncroniza el objeto en memoria con lo que el usuario escribio
            $vendedor->sincronizar($args);

            // validacion
            $errores = $vendedor->validar();

            // SUbida de Archivos
            //Generar un Nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Setear la imagen
            // Realiza un resize a la imagen con Intervetion
            if ($_FILES['vendedor']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800, 600);
                $vendedor->setImagen($nombreImagen);
            }

            if (empty($errores)) {

                if ($_FILES['vendedor']['tmp_name']['imagen']) {
                    // Almacenar la imagen
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                $vendedor->guardar();
            }
        }


        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
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
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        } 
    }
}
