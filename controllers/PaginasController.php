<?php

namespace Controllers;

use MVC\Router;
use Model\Nosotros;
use Model\Propiedad;
use Model\Blog;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::get(3);
        $blog = Blog::get(2);
        $nosotros = Nosotros::find(1);
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio,
            'nosotros' => $nosotros,
            'blog' => $blog

        ]);
    }

    public static function nosotros(Router $router)
    {
        $nosotros =  Nosotros::find(1);
        $router->render('paginas/nosotros', [
            'nosotros' => $nosotros
        ]);
    }

    public static function iconos(Router $router)
    {
        $nosotros =  Nosotros::find(1);
        $router->render('paginas/iconos', [
            'nosotros' => $nosotros
        ]);
    }
    public static function propiedades(Router $router)
    {
        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }
    public static function propiedad(Router $router)
    {
        //obtener el id
        $id = validarORedireccionar('/propiedades');

        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router)
    {
        $blog = Blog::all();
        $router->render('paginas/blog', [
            'blog' => $blog
        ]);
    }
    public static function entrada(Router $router)
    {
        //obtener el id 
        $id = validarORedireccionar('/blog');
        $blog = Blog::find($id);
        $router->render('paginas/entrada', [
            'blog' => $blog
        ]);
    }
    public static function contacto(Router $router)
    {
        $mensaje = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $respuestas = $_POST['contacto'];

            //Crear una  Instacia de Php Miler
            $mail = new PHPMailer();

            //configurar SMTP
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['EMAIL_USER'];
            $mail->Password = $_ENV['EMAIL_PASS'];
            $mail->SMTPSecure = 'tls';
            $mail->Port = $_ENV['EMAIL_PORT'];

            // Configurar el contenido del mail
            $mail->setFrom('angelmrtnic@gmail.com');
            $mail->addAddress('angelmrtnic@gmail.com', 'Bienes Raices.com');
            $mail->Subject = 'Tienes un nuevo Mensaje';

            //Habilita HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //Definir Contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo Mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre']  . '</p>';

            // Enviar de forma condicional algunos campos de email o telefono

            if ($respuestas['contacto'] === 'telefono') {
                $contenido .= '<p>Prefiere ser contactado por: ' . $respuestas['contacto']  . '</p>';
                $contenido .= '<p>Telefono: ' . $respuestas['telefono']  . '</p>';
                $contenido .= '<p>Fecha para ser Contactado: ' . $respuestas['fecha']  . '</p>';
                $contenido .= '<p>Horario en que puede ser contactado: ' . $respuestas['hora']  . '</p>';
            } else {
                // Es email, entonces agregamos el campo de email
                $contenido .= '<p>Prefiere ser contactado por: ' . $respuestas['contacto']  . '</p>';
                $contenido .= '<p>Email: ' . $respuestas['email']  . '</p>';
            }
            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje']  . '</p>';
            $contenido .= '<p>Vende o Compra: ' . $respuestas['tipo']  . '</p>';
            $contenido .= '<p>Precio o Presupuesto: $' . $respuestas['precio']  . '</p>';
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin HTML';

            // Enviar el mail
            if ($mail->send()) {
                $mensaje = "Mensaje Enviado Correctamente";
            } else {
                $mensaje = "El Mensaje No Se Pudo Enviar ...";
            }
        }
        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}
