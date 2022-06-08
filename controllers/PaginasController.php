<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{

    public static function index(Router $router){
        $propiedades = Propiedad::Consultalimite(3) ?? '';
        $header = true;
        $respuesta = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $respuestas = $_POST['contacto'];

            //Crear objeto de PHPMailer
            $mail = new PHPMailer();
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->Mailer = "smtp";
            $mail->isSMTP();
            $mail->Host = $_ENV['MAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['MAIL_USER'];
            $mail->Password = $_ENV['MAIL_PASSWORD'];
            $mail->SMTPSecure = 'tls'; //Encriptado, seguro
            $mail->Port = $_ENV['MAIL_PORT'];

            $mail->setFrom($_ENV['MAIL_USER']);
            $mail->addAddress($respuestas['email']);
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Nuevo Mensaje';

            if($respuestas['contacto'] == "telefono"){
                $disponibilidad = $respuestas['fecha'] . ' a las ' . $respuestas['hora'];
            } else {
                $disponibilidad = "Completa";
            }

            if($respuestas['opciones'] == "Compra"){
                $opcion = "Presupuesto";
            } else {
                $opcion = "Precio";
            }

            if($respuestas['mensaje'] == ""){
                $mensaje = "Necesito asesoramiento";
            } else {
                $mensaje = $respuestas['mensaje'];
            }

            //Definir contenido
            $contenido = '<html>';
            $contenido .= '<p>Nuevo mensaje</p>';
            $contenido .= '<p>Asunto: ' . $respuestas['opciones'] . '</p>';
            $contenido .= '<p>Nombre: ' . ucfirst($respuestas['nombre']) . '</p>';
            $contenido .= '<p>Correo: ' . $respuestas['email'] . '</p>';
            $contenido .= '<p>Telefono: ' . $respuestas['telefono'] . '</p>';
            $contenido .= '<p>Mensaje: ' . $mensaje . '</p>';
            $contenido .= '<p>'. $opcion . ': ' . "$" . number_format(intval($respuestas['presupuesto']), 0, ",", ".") . '</p>';
            $contenido .= '<p>Forma de contacto: ' . ucfirst($respuestas['contacto']) . '</p>';
            $contenido .= '<p>Disponibilidad: ' . $disponibilidad . '</p>';
            $contenido .= '</html>';

            $mail->Body    = $contenido;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
            //Enviar
            if($mail->send()){
                $respuesta = 1;
            }else{
                $respuesta = 5;
            }
            
        }

        $router->view('paginas/index',[
            'propiedades' => $propiedades,
            'header' => $header,
            'respuesta' => $respuesta
        ]);
    }

    public static function nosotros(Router $router){
        $router->view('paginas/nosotros',[]);
    }
    
    public static function portafolio(Router $router){
        $propiedades = Propiedad::Consulta();

        $router->view('paginas/portafolio',[
            'propiedades' => $propiedades,
        ]);
    }
    
    public static function propiedad(Router $router){
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $propiedad = Propiedad::ConsultaId($id);

        $router->view('paginas/propiedad',[
            'propiedad' => $propiedad,
        ]);

    }

    public static function blog(Router $router){
        $router->view('paginas/blog');
    }

    public static function entrada(Router $router){
        $router->view('paginas/entrada');
    }

    public static function contacto(Router $router){
    }

}