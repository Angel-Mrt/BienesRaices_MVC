<main class="contenedor seccion">
    <h1>Administrador del Blog</h1>

    <?php
    if ($resultado) {
        $mensaje = mostrarNotificacion(intval($resultado));
        if ($mensaje) { ?>
            <p class="alerta exito"> <?php echo s($mensaje) ?> </p>
    <?php }
    } ?>
    <a href="/admin" class="boton boton-verde">Volver</a>
    <a href="/blog/crear" class="boton boton-amarillo">Crear Blog</a>
    <h2>Blogs</h2>
    <div class="tabla-container">
        <table class="propiedades" id="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Autor</th>
                    <th>Imagen</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody><!--Mostrar los Resultados--->
                <?php foreach ($blog as $b) : ?>
                    <tr>
                        <td><?php echo $b->id; ?></td>
                        <td><?php echo $b->titulo; ?></td>
                        <td><?php echo $b->autor; ?></td>
                        <td><img src="../imagenes/<?php echo $b->imagen; ?>" class="imagen-tabla"></td>
                        <?php
                        $fechaCompleta = $b->fecha;
                        $fechaObjeto = new DateTime($fechaCompleta);
                        // Obtener solo la fecha (sin la hora) formateada como "YYYY-MM-DD"
                        $soloFecha = $fechaObjeto->format('Y-m-d');
                        ?>
                        <td><?php echo $soloFecha; ?></td>
                        <td>
                            <form method="POST" class="w-100" action="/blog/eliminar">
                                <input type="hidden" name="id" value="<?php echo $b->id; ?>">
                                <input type="hidden" name="tipo" value="blog">
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>
                            <div class="w-100">
                                <a href="/blog/actualizar?id=<?php echo $b->id; ?>" class="boton-amarillo-block">Actualizar</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>