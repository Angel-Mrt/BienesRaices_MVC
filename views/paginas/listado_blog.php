    <?php foreach ($blog as $b) { ?>
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <img loading="lazy" src="imagenes/<?php echo $b->imagen; ?>" alt="Texto Entrada Blog">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="/entrada?id=<?php echo $b->id; ?>">
                    <h4> <?php echo $b->titulo; ?> </h4>
                    <?php
                    $fechaCompleta = $b->fecha;
                    $fechaObjeto = new DateTime($fechaCompleta);
                    // Obtener solo la fecha (sin la hora) formateada como "YYYY-MM-DD"
                    $soloFecha = $fechaObjeto->format('Y-m-d');
                    ?>
                    <p><b>Escrito el: </b><span> <?php echo '  ' . $soloFecha; ?></span><b> Por:</b> <span> <?php echo '  ' . $b->autor; ?> </span></p>
                    <p> <?php echo $b->descripcion; ?></p>
                </a>
            </div>
        </article>
    <?php } ?>