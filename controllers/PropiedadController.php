<?php
// declare (strict_types = 1);

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as image;

class PropiedadController{
    public static function index(Router $router){
        $propiedades = Propiedad::Consulta();
        $vendedores = Vendedor::Consulta();
        $resultado = $_GET['resultado'] ?? null;

        $router->view('propiedades/admin', [
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router){
        $propiedad = new Propiedad;
        $vendedores = Vendedor::Consulta();
        $errores = Propiedad::getErrores();
        $tiempo = CerrarSeccion_tiempo();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $propiedad = new Propiedad($_POST['propiedad']);

            $nombreImagen = md5(uniqid(strval(rand()), true)) . ".jpg";
            if($_FILES['propiedad']['tmp_name']['imagen']){
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
            }
            $errores = $propiedad->Validaciones();

            if (empty($errores)) {
                if (!$tiempo) {
                    if(!is_dir(CARPETA_IMAGENES)){
                        mkdir(CARPETA_IMAGENES);
                    }
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                    if ($propiedad->Guardar()) {
                        header('Location: /admin?resultado=1');
                    }else{
                        header('Location: /admin?resultado=5');
                    }
                }
                
            }
        }

        $router->view('propiedades/crear',[
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router){
        $vendedores = Vendedor::Consulta();
        $id = Redireccionar('/admin');
        $tiempo = CerrarSeccion_tiempo();

        $propiedad = Propiedad::ConsultaId($id);
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            $args = $_POST['propiedad'];
            $propiedad->Sincronizar($args);
            $errores = $propiedad->Validaciones();
        

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
        
            if($_FILES['propiedad']['tmp_name']['imagen']){
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
                $image->save(CARPETA_IMAGENES . $nombreImagen);
            }
        
            if (empty($errores)) {
                if (!$tiempo) {
                    $resultado = $propiedad->Guardar();
                    if ($resultado) {
                        header('Location: /admin?resultado=2');
                    } 
                    
                    if($resultado === 4){
                        header('Location: /admin?resultado=4');
                    } 
                    
                    if(!$resultado){
                        header('Location: /admin?resultado=5');
                    }
                }
            }
        }

        $router->view('propiedades/actualizar',[
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'id' => $id,
            'errores' => $errores
        ]);
    }

    public static function eliminar(){
        $tiempo = CerrarSeccion_tiempo();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_var($_POST['idpropiedad'] ?? null, FILTER_VALIDATE_INT);
            if($id){
                $propiedades = Propiedad::ConsultaId($id);
                $respuesta = $propiedades->Eliminar();
            }
        
            if (!$tiempo) {
                if ($respuesta) {
                    header('Location: /admin?resultado=3');
                }
            }
        }

        // $router = view('propiedades/eliminar',[
        //     'id', $id,
        //     'vendedores', $vendedores,
        //     'propiedades', $propiedades,
        //     'respuesta', $respuesta
        // ]);
    }
}