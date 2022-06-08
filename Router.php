<?php

namespace MVC;

class Router{

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn){
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn){
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas(){
        session_start();
        $auth = $_SESSION['login'] ?? null;

        //Arreglo rutas protegidas
        $rutas_protegidas = ['/admin','/propiedades/crear','/propiedades/actualizar','/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar','/vendedores/eliminar'];

        if ($_SERVER['PATH_INFO']) {
            $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        } else {
            $currentUrl = $_SERVER['REQUEST_URI'] === '' ? '/' : $_SERVER['REQUEST_URI'];
        }
        
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET'){
            $fn = $this->rutasGET[$urlActual] ?? null;
        }else{
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        if(in_array($urlActual, $rutas_protegidas) && !$auth){
            header('Location: /');
        }

        if($urlActual == "/login" && $auth){
            header('Location: /admin');
        }

        if($fn){
            //La URL existe y hay una función asociada
            call_user_func($fn, $this);
        }else{
            include __DIR__ . "/views/paginas/error.php";
        }
    }

    //Muestra una vista
    public function view($view, $datos = []){
        foreach($datos as $key => $Value){
            $$key = $Value;
        }
        
        ob_start();//Inicia almacenamiento en memoria (bufer)
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean();//Limpiamos la vista - Toma el último valor guardado en bufer
        if($view != "auth/login"){
            include __DIR__ . "/views/layout.php";
        }else{
            echo($contenido);
        }
    }
}