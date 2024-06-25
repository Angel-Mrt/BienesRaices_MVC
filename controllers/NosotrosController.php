<?php

namespace Controllers;

use MVC\Router;
use Model\Nosotros;
use Intervention\Image\ImageManagerStatic as Image;

class NosotrosController
{

    public static function actualizar(Router $router)
    {

        $nosotros =  Nosotros::find(1);
        //arreglo con mensajes de errores
        $errores = Nosotros::getErrores();
        //Metodo Post Para actualizar
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Asignar los atributos
            $args = $_POST['nosotros'];

            $nosotros->sincronizar($args);
            //Validacion 
            $errores = $nosotros->validar();

            // SUbida de Archivos
            //Generar un Nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Setear la imagen
            // Realiza un resize a la imagen con Intervetion
            if ($_FILES['nosotros']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['nosotros']['tmp_name']['imagen'])->fit(800, 600);
                $nosotros->setImagen($nombreImagen);
            }


            if (empty($errores)) {

                if ($_FILES['nosotros']['tmp_name']['imagen']) {
                    // Almacenar la imagen

                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $nosotros->guardar();
            }
        }
        $router->render('nosotros/actualizar', [
            'nosotros' => $nosotros,
            'errores' => $errores
        ]);
    }
}
