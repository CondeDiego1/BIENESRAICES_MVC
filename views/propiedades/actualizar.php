<main class="contenedor seccion reducido">
    <h1 class="formato c-azulclaro crear">Actualizar Propiedad</h1>
    <div class="contenedor-error">
        <?php foreach ($errores as $error) : ?>
            <div class="alerta error">
                <p>Error</p>
                <p><?php echo ($error) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <script>
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
    </script>
    <form class="formulario-crear" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php'; ?>
        <input type="submit" value="Actualizar" class="boton-gris">
    </form>
    <a href="/admin" class="btn-azul">Volver</a>
</main>