<?php

namespace Model;
use Model\ActiveRecord;

class Admin extends ActiveRecord{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password'];
    public $id;
    public $email;
    public $password;
    
    function __construct(array $args = []){
        $this->id = $args['id'] ?? NULL;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function Validaciones(){
        if (!$this->email) {
            self::$errores[] = "El email es obligatorio";
        }

        if (!$this->password) {
            self::$errores[] = "La contraseña es obligatoria";
        }

        return self::$errores;
    }

    public function existeUsuario(){
        $resultado = self::$db->query("SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1");

        if(!$resultado->num_rows){
            self::$errores[] = "El usuario no existe";
        } else {
            return $resultado;
        }
    }

    public function comprobarPassword($resultado){
        $usuario = $resultado->fetch_object();
        $autenticado = password_verify($this->password, $usuario->password);

        if(!$autenticado){
            self::$errores[] = "La contraseña es incorrecta";
        } else {
            return $autenticado;
        }
    }

    public function loguear(){
        session_start();
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;
        $_SESSION["timeout"] = time();
        header('Location: /admin');
    }
}