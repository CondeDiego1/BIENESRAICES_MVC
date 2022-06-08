<main class="contenedor seccion reducido">
    <h1 class="formato c-azulclaro crear">Creación de Propiedades</h1>
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
    <form class="formulario-crear" method="POST" enctype="multipart/form-data"><!-- action="/admin/propiedades/crear.php" -->
        <?php include __DIR__ . '/formulario.php'; ?>
        
        <div class="flex flex__content flex__perfil">
            <a href="/admin" class="btn-azul">Volver</a>
            <input type="submit" value="Crear" class="boton-gris">
        </div>
    </form>
</main>
