<?php
declare(strict_types=1);
namespace Model;

class Propiedad extends ActiveRecord
{
    //------------------------------- ATRIBUTOS -------------------------------
    protected static $columnasDB = ['idpropiedad', 'nombre','precio','imagen','descripcion','habitaciones','toilette','estacionamientos','fechaModificacion','cedula'];
    protected static $tabla = 'propiedades';
    protected static $columna = 'idpropiedad';
    public $idpropiedad;
    public $nombre;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $toilette;
    public $estacionamientos;
    public $fechaModificacion;
    public $cedula;

    //------------------------------- FUNCIONES -------------------------------
    function __construct(array $args = []){
        $this->idpropiedad = $args['idpropiedad'] ?? NULL;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->toilette = $args['toilette'] ?? '';
        $this->estacionamientos = $args['estacionamientos'] ?? '';
        $this->fechaModificacion = date('Y-m-d');
        $this->cedula = $args['cedula'] ?? '';
    }

    public function Validaciones(){
        if (!$this->nombre) {
            self::$errores[] = "El nombre es obligatorio";
        }

        if (!preg_match('/[a-z]/', $this->nombre) || !preg_match('/[A-Z]/', $this->nombre)) {
            self::$errores[] = "Debe ingresar un nombre válido";
        }
    
        if (!$this->precio) {
            self::$errores[] = "El precio es obligatorio";
        }

        if (!preg_match('/[0-9]/', $this->precio)) {
            self::$errores[] = "Debe ingresar un precio válido";
        }
    
        if (strlen($this->descripcion) < 70 || strlen($this->descripcion) > 100) {
            self::$errores[] = "Debes añadir una descripción más detallada";
        }
    
        if (!$this->habitaciones) {
            self::$errores[] = "Debes añadir mínimo una habitación";
        }
    
        if (!$this->toilette) {
            self::$errores[] = "Debes añadir mínimo un baño";
        }
    
        if (!$this->estacionamientos) {
            self::$errores[] = "Debes añadir mínimo un estacionamiento";
        }
    
        if (!$this->cedula) {
            self::$errores[] = "Debes seleccionar un vendedor";
        }
    
        if (!$this->imagen) {
            self::$errores[] = "La imagene es obligatoria";
        }

        return self::$errores;
    }
}
