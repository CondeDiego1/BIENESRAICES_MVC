
<fieldset>
    <legend>Información General</legend>
    <picture>
        <source loading="lazy" srcset="/build/img/casa.avif" type="image/avif">
        <source loading="lazy" srcset="/build/img/casa.webp" type="image/webp">
        <img src="/build/img/casa.png" alt="imagen contacto" loading="lazy">
    </picture>
    <label class="sin-margen" for="nombre">Nombre <span class="rojo">*</span></label>
    <input type="text" id="nombre" name="propiedad[nombre]" placeholder="Nombre de la propiedad" value="<?php echo Sanitizar($propiedad->nombre); ?>">

    <label for="precio">Precio <span class="rojo">*</span></label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio de la propiedad" value="<?php if($propiedad->precio){echo round(intval(Sanitizar($propiedad->precio)),0);} ?>">
    
    <div class="contenedor-file">
        <label for="imagen" class="centrar"><span class="upload"></span> Subir imagen<span class="rojo">*</span></label>
        <label id="fichero" class="fichero">Ninguna imagen seleccionada</label>
    </div>
    <input type="file" id="imagen" class="subir" name="propiedad[imagen]" accept="image/jpeg, image/png">
    
    <?php if($propiedad->imagen){ ?>
        <img src="/imagenes/<?php echo ($propiedad->imagen); ?>" alt="imagen propiedad" class="imagen-small">
    <?php }?>

    <script>
        document.getElementById('imagen').onchange = function () {
            document.getElementById('fichero').innerHTML = document.getElementById('imagen').files[0].name;
        }
    </script>
    <label for="descripcion">Descripción <span class="rojo">*</span></label>
    <textarea id="descripcion" name="propiedad[descripcion]" placeholder="Descripción de la propiedad" maxlength="100" minlength="70"><?php echo Sanitizar($propiedad->descripcion); ?></textarea>
</fieldset>

<fieldset>
    <legend>Información Específica</legend>
    <picture>
        <source loading="lazy" srcset="/build/img/planos.avif" type="image/avif">
        <source loading="lazy" srcset="/build/img/planos.webp" type="image/webp">
        <img src="/build/img/planos.png" alt="imagen contacto" loading="lazy">
    </picture>
    <label class="sin-margen" for="habitaciones">Habitaciones <span class="rojo">*</span></label>
    <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ejemplo: 1" min="1" max="9"
        value="<?php echo Sanitizar($propiedad->habitaciones); ?>">

    <label for="toilette">Baños <span class="rojo">*</span></label>
    <input type="number" id="toilette" name="propiedad[toilette]" placeholder="Ejemplo: 1" min="1" max="4"
        value="<?php echo Sanitizar($propiedad->toilette); ?>">

    <label for="estacionamientos">Estacionamientos <span class="rojo">*</span></label>
    <input type="number" id="estacionamientos" name="propiedad[estacionamientos]" placeholder="Ejemplo: 1" min="1" max="9"
        value="<?php echo Sanitizar($propiedad->estacionamientos); ?>">
</fieldset>

<fieldset>
    <legend>Información Vendedor</legend>
    <picture>
        <source loading="lazy" srcset="/build/img/vendedor.avif" type="image/avif">
        <source loading="lazy" srcset="/build/img/vendedor.webp" type="image/webp">
        <img src="/build/img/vendedor.png" alt="imagen contacto" loading="lazy">
    </picture>
    <label class="sin-margen" for="cedula">Vendedor <span class="rojo">*</span></label>
    <select name="propiedad[cedula]" id="cedula" value="<?php //echo ($propiedad->cedula); ?>">
        <option value="" selected>-- Seleccione --</option>
        <?php
        foreach ($vendedores as $vendedor){ ?>
            <option <?php echo ($propiedad->cedula === $vendedor->cedula ? 'selected' : ''); ?> value="<?php echo ($vendedor->cedula) ?>"><?php echo ($vendedor->nombre) ?></option>
        <?php } ?>
    </select>
</fieldset>

<div class="contenedor-tyc-izquierda">
    <label for="terminos-condiciones">Acepto las Condiciones del servicio y la Política de privacidad de Bienes
        Raices</label>
    <input type="checkbox" required value="tyc" id="terminos-condiciones" class="tyc">
</div>