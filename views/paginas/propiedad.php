<main class="resumen">
    <div class="contenedor seccion">
        <h1 class="formato c-azul">casa frente al bosque</h1>
        <div class="resumen-imagenes">
            <div class="resumen-imagen">
                <?php for ($i = 0; $i < 3; $i++) { ?>
                    <picture>
                        <img class="img-redonda" src="imagenes/<?php echo ($propiedad->imagen) ?>" alt="imagen gmail" loading="lazy">
                    </picture>
                <?php } ?>
            </div>
            <picture class="p">
                <img class="img-redonda" src="imagenes/<?php echo ($propiedad->imagen) ?>" alt="imagen gmail" loading="lazy">
            </picture>
        </div>
        <div>
            <div class="descripcion-resumen">
                <h2>Descripción del proyecto</h2>
                <p><?php echo ($propiedad->descripcion); ?></p>
                <div class="contenido-card">
                    <p class="precio"><?php echo ("$" . round($propiedad->precio, 0)); ?></p>
                    <ul class="iconos-caracteristicas">
                        <li>
                            <img src="build/img/icono_wc.svg" alt="icono baño" loading="lazy">
                            <p><?php echo ($propiedad->toilette . " Baños"); ?></p>
                        </li>
                        <li>
                            <img src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" loading="lazy">
                            <p><?php echo ($propiedad->estacionamientos . " Estacionamientos"); ?></p>
                        </li>
                        <li>
                            <img src="build/img/icono_dormitorio.svg" alt="icono habitacion" loading="lazy">
                            <p><?php echo ($propiedad->habitaciones . " Habitaciones"); ?></p>
                        </li>
                    </ul>
                </div>
                <div class="boton-venta-compra">
                </div>
            </div>
        </div>
    </div>
</main> <!-- .informacion -->