<fieldset>
    <legend>Información General</legend>
    <div class="flex flex__perfil">
        <?php if($vendedor->fotoperfil !== "usuario.png" && $vendedor->fotoperfil !== ''){ ?>
        <img src="/perfil/<?php echo ($vendedor->fotoperfil); ?>" id="fichero" alt="imagen vendedor"
            class="fotoperfil">
        <?php } else {?>
        <img src="/build/img/usuario.png" alt="imagen contacto" id="fichero" loading="lazy" class="fotoperfil">
        <?php } ?>

        <label for="fotoperfil" class="centrar"><span class="upload"></span> Subir imagen<span
                class="rojo">*</span></label>
        <input type="file" id="fotoperfil" class="subir" name="vendedor[fotoperfil]" accept="image/jpeg, image/png"
            onchange="previewFile()">
        <!-- <img alt="imagen contacto" loading="lazy" class="fotoperfil"> -->
    </div>
    <script>
        function previewFile() {
            const preview = document.getElementById("fichero");
            const file = document.querySelector('input[type=file]').files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function () {
                preview.src = reader.result;
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>

    <label class="sin-margen" for="nombre">Nombre completo<span class="rojo">*</span></label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre del vendedor"
        value="<?php echo Sanitizar($vendedor->nombre); ?>">

    <div class="flex">
        <div>
            <label for="tipodocumento">Tipo de documento<span class="rojo">*</span></label>
            <select name="vendedor[tipodocumento]" id="tipodocumento" class="tipodocumento"
                value="<?php echo ($vendedor->tipodocumento);?>">
                <option value="" selected>-- Seleccione --</option>
                <option <?php echo ($vendedor->tipodocumento === "CC" ? 'selected' : ''); ?> value="CC">Cedula de
                    Ciudadanía</option>
                <option <?php echo ($vendedor->tipodocumento === "CE" ? 'selected' : ''); ?> value="CE">Cedula de
                    Extrangería</option>
                <option <?php echo ($vendedor->tipodocumento === "PA" ? 'selected' : ''); ?> value="PA">Pasaporte
                </option>
            </select>
        </div>
        <div>
            <label for="cedula">Número de documento<span class="rojo">*</span></label>
            <input type="number" id="cedula" name="vendedor[cedula]" placeholder="123456789"
                value="<?php if($vendedor->cedula){ echo Sanitizar($vendedor->cedula);} ?>" <?php echo ($actualizar === true ? 'readonly' : '') ?>>
        </div>
    </div>

    <label for="telefono">Teléfono celular<span class="rojo">*</span></label>
    <input type="tel" id="telefono" name="vendedor[telefono]" placeholder="1234567890"
        value="<?php echo Sanitizar($vendedor->telefono); ?>">
</fieldset>

<div class="contenedor-tyc-izquierda">
    <label for="terminos-condiciones">Acepto las Condiciones del servicio y la Política de privacidad de Bienes
        Raices</label>
    <input type="checkbox" required value="tyc" id="terminos-condiciones" class="tyc">
</div>