<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bienes Raices</title>
    <link rel="preload" href="/build/css/app.css" as="style" />
    <link rel="stylesheet" href="/build/css/app.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link rel="icon" type="image/png" href="../build/img/home.ico" />
</head>

<body>
    <main data-cy="contenedor-login" class="contenedor-login context area">
        <div class="contenedor seccion login ">
            <form data-cy="formulario-login" class="formulario-login" method="POST" action="/login" novalidate autocomplete="off">
                <fieldset>
                    <legend>Iniciar Sesión</legend>
                    <picture>
                        <source class="imagen-login" loading="lazy" srcset="/build/img/login.avif" type="image/avif">
                        <source class="imagen-login" loading="lazy" srcset="/build/img/login.webp" type="image/webp">
                        <img class="imagen-login" src="/build/img/login.png" alt="imagen login" loading="lazy">
                    </picture>
                    <div class="contenedor-error">
                        <?php foreach ($errores as $error) : ?>
                            <div class="alerta error">
                                <p>Error</p>
                                <p><?php echo ($error) ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            const notify = document.getElementsByClassName('error');
                            const notifyalerta = document.getElementsByClassName('alerta');
                            for (i = 0; i < notify.length; i++) {
                                if(notify[i]){
                                    setTimeout(function(){
                                        for(j = 0; j < notify.length; j++){
                                            notify[j].classList.add("oculto");
                                        }
                                    },9000);
                                }
                            }
                        });
                    </script>
                    <input data-cy="input-email" class="input__modificado" type="email" id="email" name="email" placeholder="Email" required autocomplete="off">
                    <div class="contenedor-ver">
                        <input data-cy="input-password" class="input__modificado" type="password" id="contraseña" name="password" placeholder="Contraseña" required autocomplete="off">
                        <label data-cy="vercontraseña" onclick="myFunction()" for="vercontraseña">
                            <img id="control" src="" alt="imagen login">
                        </label>
                    </div>
                    <script>
                        var x = document.getElementById("contraseña");
                        const control = document.getElementById("control");
                        if (x.type === "password") {
                            control.src = "/build/img/visible48.png";
                        } else {
                            control.src = "/build/img/ojo48.png";
                        }
                        function myFunction() {
                            var x = document.getElementById("contraseña");
                            const control = document.getElementById("control");
                            if (x.type === "password") {
                                x.type = "text";
                                control.src = "/build/img/ojo48.png";
                            } else {
                                x.type = "password";
                                control.src = "/build/img/visible48.png";
                            }
                        }
                    </script>
                </fieldset>
                <div>
                    <input type="submit" value="Iniciar Sesión" class="btn-azul2 btnlogin"> 
                    <a href="/" class="btn-azul2 btn-inicio">Volver</a>
                </div>
            </form>
        </div>
    </main>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>