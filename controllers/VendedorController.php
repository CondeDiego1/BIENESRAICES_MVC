<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as image;

class VendedorController{

    public static function crear(Router $router){
        $actualizar = false;
        $vendedor = new Vendedor;
        $errores = Vendedor::getErrores();
        $tiempo = CerrarSeccion_tiempo();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $vendedor = new Vendedor($_POST['vendedor']);

            if(!is_dir(CARPETA_PERFIL)){
                mkdir(CARPETA_PERFIL);
            }
            
            $nameImage = md5(uniqid(rand(), true)) . ".jpg";
            if($_FILES['vendedor']['tmp_name']['fotoperfil']){
                $image = Image::make($_FILES['vendedor']['tmp_name']['fotoperfil'])->fit(800,600);
                $vendedor->setImagen($nameImage);
                $image->save(CARPETA_PERFIL . $nameImage);
            }else{
                $vendedor->setImagen("usuario.png");
            }

            $errores = $vendedor->Validaciones();

            if (empty($errores)) {
                if (!$tiempo) {
                    if ($vendedor->GuardarV()) {
                        header('Location: /admin?resultado=1');
                    }else{
                        header('Location: /admin?resultado=5');
                    }
                }
                
            }
        }

        $router->view('vendedores/crear',[
            'actualizar' => $actualizar,
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router){
        $id = $_GET['cedula'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $actualizar = true;
        $tiempo = CerrarSeccion_tiempo();

        if (!$id) {
            header('Location: /admin');
        }

        $vendedor = Vendedor::ConsultaId($id);
        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $args = $_POST['vendedor'];
            $vendedor->Sincronizar($args);
            $errores = $vendedor->Validaciones();
            
            $nameImage = md5(uniqid(rand(), true)) . ".jpg";
            if($_FILES['vendedor']['tmp_name']['fotoperfil']){
                $image = Image::make($_FILES['vendedor']['tmp_name']['fotoperfil'])->fit(800,600);
                $vendedor->setImagen($nameImage);
                $image->save(CARPETA_PERFIL . $nameImage);
            }


            if (empty($errores)) {
                if (!$tiempo) {
                    $resultado = $vendedor->Guardar();
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

        $router->view('vendedores/actualizar',[
            'vendedor' => $vendedor,
            'errores' => $errores,
            'actualizar' => $actualizar,
            'id' => $id
        ]);
    }

    public static function eliminar(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_var($_POST['idpropiedad'] ?? null, FILTER_VALIDATE_INT);
            $tiempo = CerrarSeccion_tiempo();
            $id = filter_var($_POST['cedula'], FILTER_VALIDATE_INT);
            $vendedores = Vendedor::ConsultaId($id);
            $respuesta = $vendedores->Eliminar();

            if (!$tiempo) {
                if ($respuesta) {
                    header('Location: /admin?resultado=3');
                }
            }
        }

        // $router = view('propiedades/eliminar',[
        //     'id', $id,
        //     'vendedores', $vendedores,
        //     'respuesta', $respuesta
        // ]);
    }
}