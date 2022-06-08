<?php
// require 'app.php';

//Estas son variables (Constantes)
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER [ 'DOCUMENT_ROOT'] . '/imagenes/');
define('CARPETA_PERFIL', $_SERVER [ 'DOCUMENT_ROOT'] . '/perfil/');

function incluirTemplate(string $nombre, bool $header = false) {
    include TEMPLATES_URL . "/{$nombre}.php";
}

function autenticado() {
    session_start();
    // $auth = $_SESSION['login'] ?? false;
    if (!$_SESSION['login']) {
        header('Location: /');
    }
}

function autenticadologin() {
    session_start();
    $auth = $_SESSION['login'] ?? false;
    if ($auth) {
        return true;
    }
    return false;
}

function CerrarSeccion_tiempo(): bool {
    // Establecer tiempo de vida de la sesión en segundos
    $inactividad = 32000;
    // Comprobar si $_SESSION["timeout"] está establecida
    if (isset($_SESSION["timeout"])) {
        // Calcular el tiempo de vida de la sesión (TTL = Time To Live)
        $sessionTTL = time() - $_SESSION["timeout"];
        if ($sessionTTL > $inactividad) {
            return true;
        }
    }
    return false;
}

function Debuguear($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

//Sanitizar, escapar
function Sanitizar(string $html) : string {
    $sanitizar = htmlspecialchars($html, ENT_QUOTES);
    return $sanitizar;
}

function Notificacion(int $resultado) : string{
    $mensaje = '';
    switch($resultado){
        case 1:
            $mensaje = "El registro se creó exitosamente";
            break;
        case 2:
            $mensaje = "El registro se actualizó correctamente";
            break;
        case 3:
            $mensaje = "El registro se eliminó correctamente";
            break;
        case 4:
            $mensaje = "No se realizó ningún cambio";
            break;
        default:
            $mensaje = "Ocurrio un error, intente más tarde";
            break;
    }
    return $mensaje;
}

function Redireccionar(string $url) : int{
    $id = $_GET['idpropiedad'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header("Location: ${url}");
    }
    return $id;
}

function CerrarSesion(){
    session_start(); 
    $_SESSION = []; 
    header('Location: /');
}