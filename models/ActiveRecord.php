<?php
declare(strict_types=1);
namespace Model;

class ActiveRecord{
    
    //------------------------------- ATRIBUTOS -------------------------------
    protected static $db;//BD
    protected static $columnasDB = [];
    protected static $tabla = '';
    protected static $columna = '';
    protected static $errores = [];//Errores

    //------------------------------- FUNCIONES -------------------------------
    public static function setDB($database){//Conexión
        self::$db = $database;
    }

    public function Id(){
        if(static::$tabla == 'propiedades'){
            $id = $this->idpropiedad;
        }else if(static::$tabla == 'vendedores'){
            $id = $this->cedula;
        }
        return $id;
    }

    public function Guardar(){//Guardar registros en la BD
        $id = $this->Id();
        $resultado = false;
        $atributos = $this->SanitizarDatos();//Sanitizar los datos
        if(!is_null($id)){
            $valores = [];
            foreach ($atributos as $key => $value){
                $valores[] = "{$key}='$value'";
            }

            if(static::$tabla == 'propiedades'){
                $cambios = $this->Cambios($atributos,$id);
            } else if(static::$tabla == 'vendedores'){
                $cambios = $this->Cambios2($atributos,$id);
            }

            if($cambios){
                $resultado = self::$db->query("UPDATE ". static::$tabla ." SET " . join(', ',$valores) . " WHERE ". static::$columna . " = '" . self::$db->escape_string($id) . "'");
            }else{
                $resultado = 4;
            }
            
        }else{
            $resultado = self::$db->query("INSERT INTO ". static::$tabla ."(" . join(',', array_keys($atributos)) . ")" . " VALUES ('" . join("','", array_values($atributos)) . "')");

        }

        return $resultado;
    }

    public function GuardarV(){//Guardar registros en la BD
        $id = $this->Id();
        $resultado = false;
        $atributos = $this->SanitizarDatos();//Sanitizar los datos
        $resultado = self::$db->query("INSERT INTO ". static::$tabla ."(" . join(',', array_keys($atributos)) . ")" . " VALUES ('" . join("','", array_values($atributos)) . "')");
        //$resultado = "INSERT INTO ". static::$tabla ."(" . join(',', array_keys($atributos)) . ")" . " VALUES ('" . join("','", array_values($atributos)) . "')";
        //Debuguear($resultado);
        return $resultado;
    }

    public function Cambios($atributos,$id){
        $actualbd= $this->ConsultaId($id);
        $cambios = [];
        $cambiosN = [];
        $actual = [];
        $actualN = [];
        $bandera = false;

        foreach ($actualbd as $value){
            $actual[] = $value;
        }

        $j = 0;
        for($i = 0; $i<10; $i++){
            if($i === 0 || $i === 8){
            }else{
                $actualN[$j] = $actual[$i];
                $j++;
            }
        }
        $actualN[1] = strval(round(intval($actualN[1])));
            
        foreach ($atributos as $value){
            $cambios[] = $value;
        }

        $j = 0;
        for($i = 0; $i<9; $i++){
            if($i === 7){
            }else{
                $cambiosN[$j] = $cambios[$i];
                $j++;
            }
        }
        $cambiosN[1] = strval(round(intval($cambiosN[1])));

        for($i = 0; $i<8; $i++){
            if($actualN[$i] != $cambiosN[$i]){
                $bandera = true;
            }    
        }
        
        return $bandera;
    }

    public function Cambios2($atributos,$id){
        $actualbd= $this->ConsultaId($id);
        $cambios = [];
        $actual = [];
        $bandera = false;

        foreach ($actualbd as $value){
            $actual[] = $value;
        }
            
        foreach ($atributos as $value){
            $cambios[] = $value;
        }

        for($i = 0; $i<5; $i++){
            if($actual[$i] != $cambios[$i]){
                $bandera = true;
            }    
        }
        
        return $bandera;
    }

    public function Eliminar(){
        $id = $this->Id();
        if(!is_null($id)){
            //$resultado = "DELETE FROM ". static::$tabla ." WHERE " . static::$columna . " = '" . self::$db->escape_string($id) . "'";
            $resultado = self::$db->query("DELETE FROM ". static::$tabla ." WHERE " . static::$columna . " = '" . self::$db->escape_string($id) . "'");
            // Debuguear($resultado);
            if($resultado) {
                $this->borrarImagen();
            }
        }
        return $resultado;
    }

    public static function Consulta(){
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY " . static::$columna;
        $resultado = self::$db->query($query);

        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjeto($registro);
        } 

        $resultado->free();//Liberar memoria

        return $array;
    }

    public static function Consultalimite($limite){
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $limite;
        $resultado = self::$db->query($query);

        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjeto($registro);
        } 

        $resultado->free();//Liberar memoria

        return $array;
    }

    public static function ConsultaId($id){
        
        $query = "SELECT * FROM ". static::$tabla. " WHERE ". static::$columna . " = '{$id}'";
        // Debuguear($query);
        $resultado = self::$db->query($query);

        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjeto($registro);
        } 
        return array_shift($array);
    }

    protected static function crearObjeto($registro){
        $objeto = new static;
        foreach ($registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }
   
    public function atributos(){ //Identifica y une los atributos de la DB
        $id = $this->Id();
        $atributos = [];
        foreach(static::$columnasDB as $columnas){
            if($columnas === static::$columna && static::$columna === "idpropiedad") continue; //Para ignorarlo
            $atributos[$columnas] = $this->$columnas;
        }
        return $atributos;
    }
    
    public function SanitizarDatos(){//Limpiar la entrada de datos
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value){
            $sanitizado[$key] =  self::$db->escape_string($value);
        }

        return $sanitizado;
    }
   
    public static function getErrores(){//Validaciones
        return self::$errores;
    }
    
    public function setImagen($imagen){//Subida de archivos
        $id = $this->Id();
        if(!is_null($this->id)) {
            $this->borrarImagen();
        }

        if(static::$tabla == 'propiedades'){
            $this->imagen = $imagen;
        }else if(static::$tabla == 'vendedores'){
            $this->fotoperfil = $imagen;
        }
    }

    public function borrarImagen() {
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen); //Valida si la imagen existe
        if($existeArchivo){
            unlink(CARPETA_IMAGENES . $this->imagen);
        }    

        $existeArchivo = file_exists(CARPETA_PERFIL . $this->fotoperfil); //Valida si la imagen existe
        if($existeArchivo){
            unlink(CARPETA_PERFIL . $this->fotoperfil);
        }
    }

    //Sincroniza el objeto en memoria con los cambios realizados por el usuario
    //Reescribre el args con el array del $_POST
    public function Sincronizar($args = []){
        foreach($args as $key => $value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }

    public static function ConsultaParametro(string $columna, string $tabla, string $campo, $valor){
        
        $query = "SELECT {$columna} FROM {$tabla} WHERE $campo = {$valor}";
        $resultado = self::$db->query($query);

        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjeto($registro);
        } 

        $resultado->free();

        return $array;
    }
}