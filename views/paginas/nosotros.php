<main class="contenedor seccion">
    <h1>Conoce Sobre Nosotros</h1>
    <div class="contenido-nosotros">
        <div class="imagen">
            <picture>
                <img loading="lazy" src="imagenes/<?php echo $nosotros->imagen; ?>" alt="Sobre Nosotros">
            </picture>
        </div>
        <div class="texto-nosotros">
            <blockquote>
                <?php echo $nosotros->experiencia; ?> Años de Experiencia
            </blockquote>
            <p>
                <?php echo $nosotros->contenido; ?>
            </p>

        </div>
    </div>
</main>

<section class="contenedor seccion">
    <h1>Mas sobre Nosotros</h1>
    <?php include 'iconos.php'; ?>
</section>