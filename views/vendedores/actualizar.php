<main class="contenedor seccion">
    <h1>Actualizar Vendedor(a)</h1>
    <a href="/admin" class="boton boton-verde">Regresar</a>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    <form class="formulario" method="POST" enctype="multipart/form-data" >
        <?php include __DIR__ . '/formulario.php'; ?>
        <input type="submit" value="Actualizar Vendedor(a)" class="boton boton-verde">
    </form>

</main>