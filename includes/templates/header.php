<?php
if (!isset($_SESSION)) {
    session_start();
}
$auth = $_SESSION['login'] ?? false;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/bienesraices_crud/build/css/app.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">



</head>

<body>

    <header class="header <?php echo $inicio ? 'inicio' : ''; ?> ">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="index.php">
                    <img src="/bienesraices_crud/build/img/logo.svg" alt="Logotipo de Vienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/bienesraices_crud/build/img/barras.svg" alt="icono menu responsive">
                </div>
                <div class="derecha">

                    <img src="/bienesraices_crud/build/img/dark-mode.svg" class="dark-mode-boton" alt="Boton Modo Oscuro">
                    <nav class="navegacion">
                        <a href="/bienesraices_crud/nosotros.php">Nosotros</a>
                        <a href="/bienesraices_crud/anuncios.php">Anuncios</a>
                        <a href="/bienesraices_crud/blog.php">Blog</a>
                        <a href="/bienesraices_crud/contacto.php">Contacto</a>
                        <?php if ($auth) : ?>
                            <a href="../cerrar_sesion.php">Cerrar Sesión</a>
                        <?php endif ?>
                    </nav>
                </div>


            </div> <!--Barra-->
            <?php if ($inicio) { ?>
                <h1>Venta de casas y Departamentos Exclusivos de Lujo</h1>
            <?php } ?>
        </div><!---->
    </header>