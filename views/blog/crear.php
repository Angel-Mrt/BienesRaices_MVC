<main class="contenedor seccion">
    <h1>Crear Blog</h1>
    <a href="/blog/admin" class="boton boton-verde">Regresar</a>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php'; ?>
        <input type="submit" value="Crear Blog" class="boton boton-verde">
    </form>

</main>