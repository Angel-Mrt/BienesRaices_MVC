<main class="contenedor seccion contenido-centrado">
    <h1> <?php echo $blog->titulo; ?> </h1>

    <picture>
        <img loading="lazy" src="imagenes/<?php echo $blog->imagen; ?>" alt="imagen de la prpoiedad">
    </picture>
    <?php
    $fechaCompleta = $blog->fecha;
    $fechaObjeto = new DateTime($fechaCompleta);
    // Obtener solo la fecha (sin la hora) formateada como "YYYY-MM-DD"
    $soloFecha = $fechaObjeto->format('Y-m-d');
    ?>
    <p class="informacion-meta">Escrito el: <span> <?php echo $soloFecha; ?> </span> Por: <span><?php echo $blog->autor; ?></span></p>

    <div class="resumen-propiedad">

        <p> <?php echo $blog->contenido; ?> </p>
    </div>
</main>