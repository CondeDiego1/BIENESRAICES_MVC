<?php
// Debuguear(!isset($_SESSION));
// if (!isset($_SESSION)) {
//     session_start();
// }

$auth = $_SESSION['login'] ?? false;
if(!isset($header)){
    $header = false;
}

$tiempo = CerrarSeccion_tiempo();
if ($tiempo) {
    $_SESSION = [];
    header('Location: /login');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start(); 
    $_SESSION = []; 
    header('Location: /');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bienes Raices</title>
    <link rel="preload" href="../build/css/app.css" as="style" />
    <link rel="stylesheet" href="../build/css/app.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link rel="icon" type="image/png" href="../build/img/home.ico" />
</head>

<body>
    <header data-cy="header" class="header <?php echo ($header ? 'header' : 'header-inicio__azul header-inicio') ?>">
        <div class="contenedor">
            <nav class="navegacion">
                <a href="/">
                    <img src="../build/img/logo.svg" alt="Logotipo" class="logo-header" />
                </a>
                <ul class="lista">
                    <li class="item">
                        <?php if ($auth) { ?>
                            <a href="/admin" class="">Admin</a>
                        <?php } ?>
                    </li>
                    <li class="item"><a data-cy="hola" href="/nosotros">Nosotros</a></li>
                    <li class="item"><a href="/portafolio">Portafolio</a></li>
                    <li class="item"><a href="/blog">Blog</a></li>
                    <li class="item">
                        <?php if ($auth) { ?>
                            <a class="centrado">
                                <form method="POST" novalidate autocomplete="off">
                                    <input class="linea" type="submit" value="Cerrar Sesión"> 
                                </form>
                            </a>
                        
                        <?php } else { ?>
                            <a href="/login" class="centrado">Iniciar Sesión</a>
                        <?php } ?>
                    </li>
                    <li class="item"><a><img class="dark-mode-boton" src="../build/img/dark-mode.svg" alt="dark mode"></a></li>
                </ul>
                <div class="menu-iconos">
                    <img class="menu" src="../build/img/barras.svg" width="100%" height="100%" alt="Imagen menu">
                    <img class="close" src="../build/img/close.svg" width="100%" height="100%" alt="Imagen menu cerrar">
                </div>
            </nav>
        </div>
        <!-- .barra -->
    </header>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        try {
            menuHamburguesa();
        } catch (error) {}
        });
    </script>

    <?php echo($contenido); ?>

    <footer class="footer bg-azul">
        <div class="contenedor contenedor-footer">
            <div class="contenedor-imagen">
                <img class="logo-footer" src="../build/img/logo.svg" alt="Imagen logo">
                <div>
                    <!-- <h2>Obtener actualizaciones</h2> -->
                    <p>Ingresa tu email para recibir actualizaciones sobre nuevas propiedades.</p>
                    <form action="" class="suscripcion" autocomplete="off">
                        <fieldset>
                            <!-- <input type="text" name="nombre" id="nombre" placeholder="Nombre completo" autocomplete="off" /> -->
                            <input type="email" name="email" id="email" placeholder="Email@email.com"/>
                        </fieldset>
                        <input type="submit" value="" class="btn-suscripcion btn-blanco"/>
                    </form>
                </div>
            </div>

            <div class="contenedor-info">
                <h2>¿Qué hacemos?</h2>
                <p>Hacemos realidad sueños inmboliarios.</p>
                <p>Personal altamente capacitado.</p>
                <p>Destacamos frente a la competencia.</p>
                <p>Otros servicios.</p>
                <p>Proyectos con los mejores precios.</p>
                <p>Espacios a tu medida.</p>
                <p>Ofrecemos proyectos rápidos y seguros.</p>
            </div>

            <div class="contenedor-contactos">
                <h2>Ubicación</h2>
                <p>Carrera 123 # 12-34 Oficina 123</p>
                <p>Medellín, Colombia</p>
                <div class="footer__networks">
                    <h2>Contactos</h2>
                    <div>
                        <a href="#" class="iconos">
                            <picture>
                                <source loading="lazy" srcset="../build/img/facebook_2.webp" type="image/webp">
                                <img src="../build/img/facebook_2.png" alt="imagen facebook" loading="lazy">
                            </picture>
                        </a>
                        <a href="#" class="iconos">
                            <picture>
                                <source loading="lazy" srcset="../build/img/twitter_2.webp" type="image/webp">
                                <img src="../build/img/twitter_2.png" alt="imagen twitter" loading="lazy">
                            </picture></i>
                        </a>
                        <a href="#" class="iconos">
                            <picture>
                                <source loading="lazy" srcset="../build/img/gmail_2.webp" type="image/webp">
                                <img src="../build/img/gmail_2.png" alt="imagen gmail" loading="lazy">
                            </picture></i>
                        </a>
                        <!-- href="mailto:correo@gmail.com" -->
                        <a href="#" class="iconos">
                            <picture>
                                <source loading="lazy" srcset="../build/img/whatsapp_2.webp" type="image/webp">
                                <img src="../build/img/whatsapp_2.png" alt="imagen whatsapp" loading="lazy">
                            </picture></i>
                        </a>
                        <a href="#" class="iconos">
                            <picture>
                                <source loading="lazy" srcset="../build/img/instagram_2.webp" type="image/webp">
                                <img src="../build/img/instagram_2.png" alt="imagen instagram" loading="lazy">
                            </picture></i>
                        </a>
                    </div>
                </div><!-- .footer__networks -->
            </div>
        </div>

        <div class="contenedor derechos">
            <p class="copyright">Copyright &copy; all rights reserved 2022.</p>
            <p>Developed with<img class="corazon" src="../build/img/heart.svg" alt="Imagen corazon">by Diego Conde López.</p>
        </div>
    </footer><!-- .footer-->

<script defer src="../build/js/bundle.min.js"></script>
</body>
</html>