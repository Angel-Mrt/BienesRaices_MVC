<main class="contenedor seccion">
    <h1>Crear Vendedor</h1>
    <a href="/admin" class="boton boton-verde">Regresar</a>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    <form class="formulario" method="POST" enctype="multipart/form-data" action="/vendedores/crear">
        <?php include __DIR__ . '/formulario.php'; ?>
        <input type="submit" value="Crear vendedor" class="boton boton-verde">
    </form>

</main>