<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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

            $mail->Body = "
            <html>
                <body style='width:500px; max-width:500px; margin:0 auto; font-family:Poppins,sans-serif; padding: 20px; background-color: #000000; color: #ffffff;'>
                    <img style='max-width: 100%; width: 240px; margin-left: -1.2rem;' src='../public/build/img/logo.svg' alt='Logotipo'/>
                    <h2 font-size='25px' font-weight='500' line-height='25px'>¡Gracias por ponerte en contacto!</h2>
                    <p>Hola, " . ucfirst($respuestas['nombre']) . ", te pusiste en contacto por <span>". $respuestas['opciones'] . "</span> de un proyecto.</p>;
                    <p>Correo: " . $respuestas['email'] . "</p>;
                    <p>Telefono: " . $respuestas['telefono'] . "</p>;
                    <p>Mensaje: " . $mensaje . "</p>;
                    <p>". $opcion . ': ' . "$" . number_format(intval($respuestas['presupuesto']), 0, ",", ".") . "</p>;
                    <p>Forma de contacto: " . ucfirst($respuestas['contacto']) . "</p>;
                    <p>Disponibilidad: " . $disponibilidad . "</p>;
                    <p>Te invitamos a estar pendiente a tu " . ucfirst($respuestas['contacto']) . "</p>;
                </body>
            </html>";
            
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