<?php
declare(strict_types=1);
namespace Model;

class Vendedor extends ActiveRecord
{
    //------------------------------- ATRIBUTOS -------------------------------
    protected static $columnasDB = ['cedula', 'nombre','telefono','tipodocumento','fotoperfil'];
    protected static $tabla = 'vendedores';
    protected static $columna = 'cedula';
    public $cedula;
    public $nombre;
    public $telefono;
    public $tipodocumento;
    public $fotoperfil;

    //------------------------------- FUNCIONES -------------------------------

    function __construct(array $args = []){
        $this->cedula = $args['cedula'] ?? NULL;
        $this->nombre = $args['nombre'] ?? '';
        $this->telefono = $args['telefono'] ?? '';      
        $this->tipodocumento = $args['tipodocumento'] ?? '';      
        $this->fotoperfil = $args['fotoperfil'] ?? '';      
    }

    public function Validaciones(){
        if ($this->cedula < 10000000 || $this->cedula > 9999999999) {
            self::$errores[] = "El número de identificación es obligatorio";
        }


        if (!preg_match('/[0-9]/', $this->cedula)) {
            self::$errores[] = "Debe ingresar un número de documento válido";
        }

        if (!preg_match('/[a-z]/', $this->nombre) || !preg_match('/[A-Z]/', $this->nombre)) {
            self::$errores[] = "Debe ingresar un nombre válido";
        }

        if (strlen($this->nombre) < 10) {
            self::$errores[] = "El nombre es obligatorio o es muy corto";
        }
    
        if (!$this->telefono) {
            self::$errores[] = "El teléfono es obligatorio";
        }

        if (!preg_match('/[0-9]{10}/', $this->telefono)) {
            self::$errores[] = "Debe ingresar un número de teléfono válido";
        }

        if (!$this->tipodocumento) {
            self::$errores[] = "El tipo de documento es obligatorio";
        }

        return self::$errores;
    }

}