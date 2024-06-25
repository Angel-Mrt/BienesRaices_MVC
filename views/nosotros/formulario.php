        <fieldset>
            <legend>Informacion General</legend>

            <label for="experiencia"> Años de Experiencia:</label>
            <input type="text" id="experiencia" name="nosotros[experiencia]" placeholder="experiencia Nosotros" value="<?php echo s($nosotros->experiencia); ?>">

            <label for="imagen"> Imagen</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="nosotros[imagen]" onchange="visualizarImagen(event)">
            <div id="previewImagen" class="imagen-small"></div>
            <?php if ($nosotros->imagen) : ?>
                <img src="../../imagenes/<?php echo $nosotros->imagen ?>" id="imagen_existente" class="imagen-small" alt="">
            <?php endif; ?>

            <label for="contenido"> Descripcion General:</label>
            <textarea id="contenido" name="nosotros[contenido]"> <?php echo s($nosotros->contenido); ?> </textarea>

            <label for="seguridad"> Descripcion Seguridad:</label>
            <textarea id="seguridad" name="nosotros[seguridad]"> <?php echo s($nosotros->seguridad); ?> </textarea>

            <label for="precio"> Descripcion Precio:</label>
            <textarea id="precio" name="nosotros[precio]"> <?php echo s($nosotros->precio); ?> </textarea>

            <label for="tiempo"> Descripcion Tiempo:</label>
            <textarea id="tiempo" name="nosotros[tiempo]"> <?php echo s($nosotros->tiempo); ?> </textarea>

        </fieldset>