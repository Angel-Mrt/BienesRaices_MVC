        <fieldset>
            <legend>Informacion para el Blog</legend>

            <label for="titulo"> Titulo</label>
            <input type="text" id="titulo" name="blog[titulo]" placeholder="Titulo Blog" value="<?php echo s($blog->titulo); ?>">

            <label for="autor"> Autor</label>
            <input type="text" id="autor" name="blog[autor]" placeholder="autor" value="<?php echo s($blog->autor); ?>">

            <label for="descripcion"> Resumen del Blog:</label>
            <textarea id="descripcion" name="blog[descripcion]"> <?php echo s($blog->descripcion); ?> </textarea>

            <label for="contenido"> Contenido del Blog: </label>
            <textarea id="contenido" name="blog[contenido]"> <?php echo s($blog->contenido); ?> </textarea>

            <label for="imagen"> Imagen</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="blog[imagen]" onchange="visualizarImagen(event)">
            <div id="previewImagen" class="imagen-small"></div>
            <?php if ($blog->imagen) : ?>
                <img src="../../imagenes/<?php echo $blog->imagen ?>" class="imagen-small" alt="" id="imagen_existente">
            <?php endif; ?>
            <input type="hidden" id="fechaBlog" name="blog[fecha]" value="<?php echo date('Y-m-d H:i:s'); ?>">


        </fieldset>