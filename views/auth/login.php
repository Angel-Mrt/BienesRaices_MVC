<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesion</h1>

    <?php
    foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php endforeach; ?>
    <form method="POST" class="formulario" action="/login">
        <fieldset>
            <legend>Email & Password</legend>
            <label for="email">E-mail</label>
            <input id="email" name="email" type="text" placeholder="Tu email" >

            <label for="password">Password</label>
            <input id="Password" name="password" type="password" placeholder="Tu Password" >
        </fieldset>
        <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
    </form>
    <br><br><br>
</main>