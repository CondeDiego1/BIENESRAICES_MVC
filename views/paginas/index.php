<section class="presentacion">
  <div class="overlay"></div>
  <div class="overlay-texto contenedor">
    <h1 data-cy='heading-sitio'>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
    <a>
      <button data-cy="btn-contacto" class="btn-blanco btn-abrir-popup">Quiero más información</button>
    </a>
  </div>
</section>
<!-- .presentacion -->

<main class="informacion">
  <div class="contenedor seccion">
    <h2 class="formato" data-cy='titulo-informacion'>el inmueble ideal para ti</h2>
    <div class="sobrenosotros" data-cy="iconos">
      <div class="icono">
        <img src="build/img/escudo.gif" alt="icono seguridad" loading="lazy" />
        <h3 class="formato-icono">Seguridad</h3>
        <p class="formatop">
          Possimus, suscipit repudiandae. Autem deserunt aliquid deleniti sit
          minus consectetur obcaecati molestiae dolorem natus dolores
        </p>
      </div>
      <div class="icono">
        <img src="build/img/dinero.gif" alt="icono dinero" loading="lazy" />
        <h3 class="formato-icono">Precios</h3>
        <p class="formatop">
          Possimus, suscipit repudiandae. Autem deserunt aliquid deleniti sit
          minus consectetur obcaecati molestiae dolorem natus dolores
        </p>
      </div>
      <div class="icono">
        <img src="build/img/reloj.gif" alt="icono tiempo" loading="lazy" />
        <h3 class="formato-icono">Tiempo</h3>
        <p class="formatop">
          Possimus, suscipit repudiandae. Autem deserunt aliquid deleniti sit
          minus consectetur obcaecati molestiae dolorem natus dolores
        </p>
      </div>
    </div>
    <!-- .sobrenosotros -->
  </div>
</main>
<!-- .informacion -->

<section class="contenedor">
  <h2 class="formato c-azulclaro">conoce nuestros proyectos descatados</h2>
  <?php include 'anuncios.php'; ?>
</section>

    <?php if (isset($respuesta)){
      if ($respuesta == 1 || $respuesta == 5) { ?>
        <div data-cy="alerta-envio-formulario" class="msg-alerta <?php echo ("active"); ?>">
            <div class="contenedor-mensaje <?php echo ($resultado == 5 ? 'bg-rojo' : 'bg-azul__exito');?>">
                <a id="btn-cerrar-popup" class="btn-popup">
                    <i data-cy="cerrar-popup" class="fas fa-times btn-cerrar-popup"></i>
                </a>
                <h1>Mensaje</h1>
                <h2 class="margin-bottom">
                    <?php 
                      if($respuesta == 1){
                        echo "Mensaje Enviado Correctamente";
                      } else if ($respuesta == 5){
                        echo "No se pudo enviar el mensaje";
                      }
                    ?>
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
    <?php } $respuesta = null; } ?>
<!-- anuncios -->

<div class="contenedor btn-azul-centro">
  <a href="/portafolio" data-cy="ver-mas-propiedades">
    <button class="centrar">Ver más proyectos</button>
  </a>
</div>

<section class="contacto-imagen">
  <div class="contenedor" data-cy="contacto">
    <h2 class="formato">Encuentra el proyecto de tus sueños</h2>
    <p>Completa el formulario de contacto y un asesor se comunicará contigo para resolver todas tus dudas.</p>
    <button class="btn-azul btn-abrir-popup">Quiero más información</button>
  </div>

  <div data-cy="overlay-popup" class="overlay-popup">
    <div class="contenedor2 contenedor-formulario">
      <a id="btn-cerrar-popup" class="btn-cerrar-popup btn-popup">
        <i class="fas fa-times"></i>
      </a>
      <picture>
        <source loading="lazy" srcset="build/img/contacto1.avif" type="image/avif" />
        <source loading="lazy" srcset="build/img/contacto1.webp" type="image/webp" />
        <img src="build/img/contacto1.png" alt="imagen contacto" loading="lazy" />
      </picture>
      <h1 class="formato">Quiero más información sobre este inmueble</h1>
      <h2>
        Comunícate con uno de nuestros asesores de linea para resolver dudas
        0123456789
      </h2>
      <form data-cy="formulario-contacto" action="/" class="formulario" autocomplete="off" method="POST">
        <fieldset>
          <legend>Información Personal</legend>
          <input data-cy="input-nombre" type="text" id="nombre" name="contacto[nombre]" placeholder="Nombre completo" autocomplete="off"  required onkeypress="return (event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 32)"/>
          <input data-cy="input-email" type="email" id="email" name="contacto[email]" placeholder="Email@email.com" autocomplete="off"  required/>
          <input data-cy="input-telefono" type="tel" id="telefono" name="contacto[telefono]" placeholder="Teléfono" autocomplete="off" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="10" minlength="10" required/>
          <textarea data-cy="input-mensaje" name="contacto[mensaje]" id="mensaje" placeholder="Necesito asesoramiento" autocomplete="off"></textarea>
        </fieldset>

        <fieldset>
          <legend>Información sobre el inmueble</legend>
          <div class="flex-contacto">
            <div>
              <label for="opciones" class="alinear-izquierda">Venta o Compra:</label>
              <select data-cy="select-contacto" name="contacto[opciones]" id="opciones" required>
                <option class="transparente" value="" disabled selected>-- Seleccione --</option>
                <option class="transparente" value="Compra">Compra</option>
                <option class="transparente" value="Venta">Venta</option>
              </select>
            </div>

            <div>
              <label for="mensaje" class="alinear-izquierda">Precio o Presupuesto:</label>
              <input data-cy="input-presupuesto" type="number" name="contacto[presupuesto]" id="presupuesto" placeholder="Precio/Presupuesto" autocomplete="off" />
            </div>
          </div>
        </fieldset>

        <fieldset>
          <legend>Quiero que me contacten por:</legend>
          <label for="preferencia" class="alinear-izquierda">Como desea ser contactado:</label>
          <div class="forma-contacto">
            <input name="contacto[contacto]" type="radio" value="telefono" id="contactar-telefono" class="contactar-telefono" required/>
            <label data-cy="forma-contacto" for="contactar-telefono" class="alinear-izquierda">Teléfono</label>

            <input type="radio" value="email" id="contactar-email" class="contactar-email" required/>
            <label data-cy="forma-contacto" for="contactar-email" class="alinear-izquierda">Email</label>
          </div>

          <div class="fecha-hora">
            <label for="fecha">Fecha:</label>
            <input data-cy="input-fecha" type="date" name="contacto[fecha]" id="fecha"/>

            <label for="hora">Hora:</label>
            <input data-cy="input-hora" type="time" name="contacto[hora]" id="hora" min="09:00" max="18:00" />
          </div>
        </fieldset>

        <div class="contenedor-tyc">
          <label for="terminos-condiciones">Acepto política de tratamiento de datos</label>
          <input data-cy="checkbox-tyc" type="checkbox" required value="tyc" id="terminos-condiciones" class="terminos-condiciones" />
        </div>

        <input data-cy="submit-contacto" type="submit" value="Enviar" class="btn-blanco ocultar" />
      </form>
    </div>
  </div>
</section>

<div class="contenedor seccion seccion-inferior">
  <section class="blog" data-cy="blog">
    <h3 class="formato">Ideas para desarrollar</h3>
    <article>
      <a class="entrada-blog" href="/entrada">
        <div class="imagen-entrada">
          <picture>
            <source srcset="build/img/idea1.avif" type="image/avif" />
            <source srcset="build/img/idea1.webp" type="image/webp" />
            <img src="build/img/idea1.jpg" alt="imagen entrada blog" />
          </picture>
        </div>

        <div class="texto-entrada">
          <h4>Ambienta tus espacios con nuevos diseños</h4>
          <p>
            Redacción Bienes Raices;
            <span> 01 de febrero 2022, 08:35 A. M.</span>
          </p>
          <p class="margin-top">
            Dale una nueva vida a esos espacios en los que tanto disfrutas pasar
            el tiempo, siguiendo los siguientes consejos para renovar de forma
            fácil y con los mejores materiales tus interiores y/o exteriores.
          </p>
        </div>
      </a>
    </article>
    <!-- .entrada-blog-->

    <article>
      <a class="entrada-blog" href="/entrada">
        <div class="imagen-entrada">
          <picture>
            <source srcset="build/img/idea5.avif" type="image/avif" />
            <source srcset="build/img/idea3.webp" type="image/webp" />
            <img src="build/img/idea3.png" alt="imagen entrada blog" />
          </picture>
        </div>

        <div class="texto-entrada">
          <h4>Decora tus espacios con un estilo minimalista</h4>
          <p>
            Redacción Bienes Raices;
            <span> 01 de febrero 2022, 08:35 A. M.</span>
          </p>
          <p class="margin-top">
            ¡Decora tus espacios con un estilo minimalista! Ideas para decorar
            tu dormitorio minimalista que nos demuestran que se pueden conseguir
            grandes cosas cuando buscas decorar
          </p>
        </div>
      </a>
    </article>
    <!-- .entrada-blog-->
  </section>
  <!-- .blog -->

  <section class="comentarios" data-cy="comentarios">
    <h3 class="formato">Testimonios</h3>
    <div class="comentario">
      <blockquote>
        Renté un apartamento a través de esta agencia y todo ha sido perfecto y
        rápido. Los agentes son muy atentos, siempre están dispuestos a
        responder a todas las dudas durante el proceso del alquiler.
      </blockquote>
      <p>- Diego Conde</p>
    </div>
  </section>
</div>
