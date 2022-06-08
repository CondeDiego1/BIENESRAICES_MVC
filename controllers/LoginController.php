<?php

namespace Controllers;
use MVC\Router;
use Model\Admin;

class LoginController{
    public static function login(Router $router){
        $errores = [];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Admin($_POST);
            $errores = $auth->Validaciones();
        
            if (empty($errores)) {
                $resultado = $auth->existeUsuario();
                if(!$resultado){
                    $errores = Admin::getErrores();
                }else{
                    $autenticado = $auth->comprobarPassword($resultado);
                    if($autenticado){
                        $auth->loguear();
                    } else {
                        $errores = Admin::getErrores();
                    }
                }
            }
        }

        $router->view('auth/login',[
            'errores' => $errores
        ]);
    }

    public static function logout(Router $router){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start(); 
            $_SESSION = []; 
            header('Location: /');
        }
    }
}