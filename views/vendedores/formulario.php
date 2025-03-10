        <fieldset>
            <legend>Informacion General</legend>

            <label for="nombre"> Nombre:</label>
            <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre Vendedor(a)" value="<?php echo s($vendedor->nombre); ?>">

            <label for="apellido"> Apellido:</label>
            <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido Vendedor(a)" value="<?php echo s($vendedor->apellido); ?>">

        </fieldset>

        <fieldset>
            <legend>Informacion Extra</legend>

            <label for="telefono"> Telefono:</label>
            <input type="number" id="telefono" name="vendedor[telefono]" placeholder="Telefono Vendedor(a)" value="<?php echo s($vendedor->telefono); ?>">

            <label for="imagen"> Foto de Perfil</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="vendedor[imagen]" onchange="visualizarImagen(event)">
            <div id="previewImagen" class="imagen-small"></div>
            <?php if ($vendedor->imagen) : ?>
                <img src="../../imagenes/<?php echo $vendedor->imagen ?>" class="imagen-small" alt="" id="imagen_existente">
            <?php endif; ?>
        </fieldset>