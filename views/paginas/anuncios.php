<div class="contenedor-cards" data-cy="contenedor-cards">
    <?php foreach ($propiedades as $propiedad) { ?>
        <a href="/propiedad?id=<?php echo ($propiedad->idpropiedad); ?>">
            <div class="card">
                <img class="imagen-card" src="imagenes/<?php echo ($propiedad->imagen); ?>" alt="imagen anuncio" loading="lazy" />
                <div class="contenido-card">
                    <h3 class="formatoh"><?php echo ($propiedad->nombre) ?></h3>
                    <p><?php echo ($propiedad->descripcion) ?></p>
                    <p class="precio"><?php echo ("$" . number_format(intval($propiedad->precio), 0, ",", ".")) ?></p>
                    <ul class="iconos-caracteristicas">
                        <li>
                            <img src="build/img/icono_wc.svg" alt="icono baño" loading="lazy" />
                            <p><?php echo ($propiedad->toilette . " Baños") ?></p>
                        </li>
                        <li>
                            <img src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" loading="lazy" />
                            <p><?php echo ($propiedad->estacionamientos . " Estacionamientos") ?></p>
                        </li>
                        <li>
                            <img src="build/img/icono_dormitorio.svg" alt="icono habitacion" loading="lazy" />
                            <p><?php echo ($propiedad->habitaciones . " Habitaciones") ?></p>
                        </li>
                    </ul>
                </div>
            </div>
        </a>
    <?php } ?>
</div>
