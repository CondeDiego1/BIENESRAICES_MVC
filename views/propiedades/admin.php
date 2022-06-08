<?php use Model\Vendedor; ?>
<main class="contenedor seccion izquierda">
    <h1 class="formato c-azul">Administrador de Bienes Raices</h1>
    <?php if (!intval($resultado)<5) { ?>
    <div class="msg-alerta <?php echo (" active"); ?>">
        <div class="contenedor-mensaje <?php echo ($resultado == 5 ? 'bg-rojo' : 'bg-azul__exito');?>">
            <a id="btn-cerrar-popup" class="btn-popup">
                <i class="fas fa-times btn-cerrar-popup"></i>
            </a>
            <h1>Mensaje</h1>
            <h2 class="margin-bottom">
                <?php echo (Notificacion(intval($resultado)))?>
            </h2>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const cerrarPopup = document.querySelector(".btn-cerrar-popup");
                const msg_alerta = document.querySelector(".msg-alerta");
                const body = document.querySelector("body");
                cerrarPopup.addEventListener("click", function () {
                    msg_alerta.classList.remove("active");
                    body.classList.remove("fijar-body");
                    eliminarURL();
                });

                function noatras() {
                    window.location.hash = "no-back-button";
                    window.location.hash = "Again-No-back-button"
                    window.onhashchange = function () {
                        window.location.hash = "no-back-button";
                    }
                }

                msg_alerta.addEventListener("click", function (e) {
                    if (e.target == this) {
                        msg_alerta.classList.remove("active");
                        body.classList.remove("fijar-body");
                        eliminarURL();
                    }
                });

                body.addEventListener('keyup', function (e) {
                    var keycode = e.keyCode || e.which;
                    if (keycode == 13 || keycode == 32) {
                        msg_alerta.classList.remove("active");
                        body.classList.remove("fijar-body");
                        eliminarURL();
                    }
                });

                //El resultado queda en el URL y si se actualiza la página sale el mensaje, entonces elimina el resultado
                function eliminarURL() {
                    const parametrosUrl = window.location;
                    window.history.replaceState(null, document.title, window.location.origin + window.location.pathname);
                }

                if (window.history.replaceState) { //verificamos disponibilidad
                    window.history.replaceState(null, null, window.location.href);
                }
            });
        </script>
    </div>
    <?php $resultado = null; } ?>

    <div class="contenedor-app">
        <div class="app">
            <nav class="tabs">
                <button type="button" data-paso="1" class="btn-blanco">Propiedades</button>
                <button type="button" data-paso="2" class="btn-blanco">Vendedores</button>
            </nav>

            <div id="paso-1" class="apartado">
                <table class="propiedades">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Imagen</th>
                            <th>Precio</th>
                            <th>Vendedor</th>
                            <th>Modificación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <!-- Mostrar resultados -->
                        <?php foreach ($propiedades as $propiedad) { ?>
                        <tr>
                            <td>
                                <?php echo ($propiedad->nombre); ?>
                            </td>
                            <td><img src="../imagenes/<?php echo ($propiedad->imagen); ?>" class="imagen-tabla"
                                    alt="imagen propiedad"></td>
                            <td>
                                <?php echo ("$" . number_format(intval($propiedad->precio), 0, ",", ".")); ?> 
                            </td>
                            <?php
                            $vendedoresN = Vendedor::ConsultaParametro("nombre","vendedores","cedula",$propiedad->cedula);
                            foreach($vendedoresN as $vendedorn){ ?>
                            <td>
                                <?php echo ($vendedorn->nombre); } ?>
                            </td>
                            <td>
                                <?php echo ($propiedad->fechaModificacion); ?>
                            </td>
                            <td class="acciones">
                                <a class="hvr-buzz-out" href="propiedades/actualizar?idpropiedad=<?php echo ($propiedad->idpropiedad); ?>">
                                    <img class="imagen-accion" src="../build/img/icons8-edit.svg" alt="Actualizar">
                                </a>
                                <form method="POST" class="w-100" action="/propiedades/eliminar">
                                    <input type="hidden" name="idpropiedad"
                                        value="<?php echo ($propiedad->idpropiedad); ?>">
                                    <input type="submit" value="" class="eliminar hvr-buzz-out">
                                    <script>
                                        if (window.history.replaceState) {
                                            window.history.replaceState(null, null, window.location.href);
                                        }
                                    </script>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>

                </table> <!-- .propiedades -->
                <div class="left">
                    <p class="resultado">Mostrando
                        <?php $registros = count($propiedades); echo ($registros); ?> resultados
                    </p>
                    <div class="animacion-plus"><a href="/propiedades/crear" class=""></a></div>
                </div>
            </div>

            <div id="paso-2" class="apartado">
                <div class="contenedor-vendedor">
                    <?php foreach($vendedores as $vendedor) { ?>
                        <section class="card">
                            <div class="card-imagen">
                                <?php if($vendedor->fotoperfil === "usuario.png"){?>
                                    <img src="../build/img/usuario.png" alt="Foto perfil">
                                <?php } else {?>
                                <img src="../perfil/<?php echo ($vendedor->fotoperfil); ?>" alt="Foto perfil">
                                <?php } ?>
                            </div>
                            <div class="card-informacion">
                                <h2><?php echo($vendedor->nombre); ?></h2>
                                <p class="m-4"><span><?php echo($vendedor->tipodocumento);?>.</span><?php echo($vendedor->cedula); ?></p>
                                <p><span>Tel.</span><?php echo($vendedor->telefono); ?></p>
                            </div>
                            <div class="acciones">
                                <a class="hvr-buzz-out" href="vendedores/actualizar?cedula=<?php echo ($vendedor->cedula); ?>">
                                    <img class="imagen-accion" src="../build/img/icons8-edit.svg" alt="Actualizar">
                                </a>
                                <form method="POST" action="/vendedores/eliminar">
                                    <input type="hidden" name="cedula" value="<?php echo ($vendedor->cedula); ?>">
                                    <input type="submit" value="" class="eliminar hvr-buzz-out">
                                    <script>
                                        if (window.history.replaceState) {
                                            window.history.replaceState(null, null, window.location.href);
                                        }
                                    </script>
                                </form>
                            </div>          
                        </section>
                    <?php } ?>        
                </div>
                <div class="left">
                    <p class="resultado">Mostrando <?php $registros = count($vendedores); echo ($registros); ?> resultados </p>
                    <div class="animacion-plus"><a href="/vendedores/crear"></a></div>
                </div>
            </div>

            <script>
                let pagina = 1;
                document.addEventListener("DOMContentLoaded", function () {
                try {
                    iniciarApp();
                } catch (error) {}
                });
                function iniciarApp() {
                    cambiarSeccion();
                    mostrarSeccion();
                }

                function cambiarSeccion() {
                    const enlaces = document.querySelectorAll(".tabs button");
                    enlaces.forEach((enlace) => {
                        enlace.addEventListener("click", (e) => {
                            e.preventDefault();
                            pagina = parseInt(e.target.dataset.paso);
                            mostrarSeccion();
                        });
                    });
                }

                function mostrarSeccion() {
                    const seccionAnterior = document.querySelector(".mostrar-seccion");
                    if (seccionAnterior) {
                        seccionAnterior.classList.remove("mostrar-seccion");
                    }

                    const seccionActual = document.querySelector(`#paso-${pagina}`);
                    seccionActual.classList.add("mostrar-seccion");

                    const tabAnterior = document.querySelector(".actual");
                    if (tabAnterior) {
                        tabAnterior.classList.remove("actual");
                    }

                    const tab = document.querySelector(`[data-paso="${pagina}"]`);
                    tab.classList.add("actual");
                }
            </script>
        </div>
</main>