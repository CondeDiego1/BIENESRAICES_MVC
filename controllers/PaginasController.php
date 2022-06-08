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
                    <svg style='max-width: 100%; width: 240px; margin-left: -1.2rem;' version='1.1' id='Capa_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' viewBox='0 0 328 54' style='enable-background:new 0 0 328 54;' xml:space='preserve'>
                        <style type='text/css'>
                            .st0{enable-background:new    ;}
                            .st1{fill:#FFFFFF;}
                        </style>
                        <g class='st0'>
                        <path class='st1' d='M21,45V13.9h9c1.8,0,3.3,0.2,4.6,0.5c1.3,0.4,2.4,0.9,3.2,1.6c0.9,0.7,1.5,1.5,1.9,2.5s0.6,2.1,0.6,3.3
                        c0,0.8-0.1,1.6-0.4,2.4c-0.3,0.8-0.7,1.5-1.2,2.1c-0.5,0.6-1.2,1.2-2,1.7S35,28.8,34,29c2.4,0.4,4.3,1.2,5.7,2.4s2,2.9,2,5
                        c0,1.3-0.2,2.5-0.7,3.6c-0.5,1.1-1.2,2-2,2.7s-2,1.3-3.3,1.7c-1.3,0.4-2.8,0.6-4.4,0.6H21z M23.2,28.4H30c1.4,0,2.7-0.2,3.7-0.5
                        c1-0.4,1.9-0.9,2.5-1.5c0.7-0.6,1.1-1.3,1.4-2c0.3-0.8,0.5-1.5,0.5-2.4c0-2.1-0.7-3.7-2-4.8c-1.3-1.1-3.4-1.6-6.1-1.6h-6.7V28.4z
                        M23.2,30.1v13.1h7.8c2.7,0,4.8-0.6,6.2-1.8c1.4-1.2,2.1-2.8,2.1-5c0-1-0.2-1.9-0.6-2.7c-0.4-0.8-0.9-1.5-1.6-2s-1.6-1-2.6-1.3
                        c-1-0.3-2.2-0.4-3.5-0.4H23.2z'/>
                        <path class='st1' d='M52.3,45H50V13.9h2.3V45z'/>
                        <path class='st1' d='M81,13.9v1.9H64.6v12.6h13.6v1.8H64.6v13H81V45H62.4V13.9H81z'/>
                        <path class='st1' d='M89.9,13.9c0.1,0.1,0.2,0.2,0.4,0.3l20.2,27c0-0.4-0.1-0.9-0.1-1.3V13.9h2V45h-1.1c-0.3,0-0.6-0.1-0.8-0.4
                        l-20.2-27c0,0.4,0.1,0.9,0.1,1.3V45h-2V13.9h1.1C89.7,13.9,89.8,13.9,89.9,13.9z'/>
                        <path class='st1' d='M140.3,13.9v1.9h-16.4v12.6h13.6v1.8h-13.6v13h16.4V45h-18.7V13.9H140.3z'/>
                        <path class='st1' d='M162.7,17.7c-0.1,0.2-0.3,0.4-0.6,0.4c-0.2,0-0.4-0.1-0.7-0.4s-0.7-0.6-1.2-0.9c-0.5-0.3-1.2-0.6-1.9-0.9
                        c-0.8-0.3-1.7-0.4-2.9-0.4c-1.1,0-2.1,0.2-3,0.5c-0.9,0.3-1.6,0.8-2.2,1.3c-0.6,0.6-1,1.2-1.3,1.9s-0.5,1.5-0.5,2.3
                        c0,1.1,0.2,1.9,0.7,2.6c0.4,0.7,1,1.3,1.8,1.8c0.7,0.5,1.6,0.9,2.5,1.2s1.9,0.7,2.9,1c1,0.3,1.9,0.7,2.9,1.1
                        c0.9,0.4,1.8,0.9,2.5,1.5c0.7,0.6,1.3,1.3,1.8,2.2c0.4,0.9,0.7,1.9,0.7,3.2c0,1.3-0.2,2.5-0.7,3.7c-0.4,1.2-1.1,2.2-1.9,3
                        c-0.8,0.9-1.9,1.5-3.1,2c-1.2,0.5-2.6,0.7-4.2,0.7c-2.1,0-3.8-0.4-5.3-1.1c-1.5-0.7-2.8-1.7-3.9-3l0.6-1c0.2-0.2,0.4-0.3,0.6-0.3
                        c0.1,0,0.3,0.1,0.5,0.3s0.5,0.4,0.7,0.6c0.3,0.3,0.6,0.5,1.1,0.8s0.9,0.6,1.4,0.8c0.5,0.3,1.2,0.5,1.9,0.6s1.5,0.3,2.4,0.3
                        c1.2,0,2.3-0.2,3.3-0.6c1-0.4,1.8-0.9,2.5-1.5c0.7-0.6,1.2-1.4,1.5-2.3c0.4-0.9,0.5-1.8,0.5-2.8c0-1.1-0.2-2-0.7-2.7
                        c-0.4-0.7-1-1.3-1.8-1.8c-0.7-0.5-1.6-0.9-2.5-1.2c-0.9-0.3-1.9-0.6-2.9-0.9c-1-0.3-1.9-0.7-2.9-1c-0.9-0.4-1.8-0.9-2.5-1.5
                        c-0.7-0.6-1.3-1.3-1.8-2.2c-0.4-0.9-0.7-2-0.7-3.3c0-1,0.2-2,0.6-3c0.4-1,1-1.8,1.7-2.6c0.8-0.7,1.7-1.3,2.8-1.8s2.4-0.7,3.8-0.7
                        c1.6,0,3.1,0.3,4.4,0.8s2.5,1.3,3.5,2.4L162.7,17.7z'/>
                        </g>
                        <g class='st0'>
                        <path class='st1' d='M175.3,32.6V45h-5.9V13.2h9.7c2.2,0,4,0.2,5.6,0.7c1.5,0.4,2.8,1.1,3.8,1.9c1,0.8,1.7,1.8,2.2,2.9
                        s0.7,2.4,0.7,3.7c0,1.1-0.2,2.1-0.5,3s-0.8,1.8-1.4,2.6c-0.6,0.8-1.3,1.5-2.2,2c-0.9,0.6-1.9,1.1-3,1.4c0.7,0.4,1.4,1,1.9,1.8
                        l8,11.7h-5.3c-0.5,0-1-0.1-1.3-0.3c-0.4-0.2-0.7-0.5-0.9-0.9L180,33.6c-0.2-0.4-0.5-0.7-0.8-0.8c-0.3-0.2-0.7-0.2-1.3-0.2H175.3z
                        M175.3,28.3h3.7c1.1,0,2.1-0.1,2.9-0.4c0.8-0.3,1.5-0.7,2-1.2s0.9-1.1,1.2-1.7c0.3-0.7,0.4-1.4,0.4-2.2c0-1.6-0.5-2.9-1.6-3.7
                        c-1.1-0.9-2.7-1.3-4.9-1.3h-3.8V28.3z'/>
                        <path class='st1' d='M226,45h-4.6c-0.5,0-0.9-0.1-1.3-0.4s-0.6-0.6-0.7-1l-2.4-6.5h-13.2l-2.4,6.5c-0.1,0.3-0.3,0.6-0.7,0.9
                        s-0.8,0.4-1.3,0.4H195l12.5-31.8h6.1L226,45z M205.4,33h10.1l-3.9-10.6c-0.2-0.5-0.4-1-0.6-1.7c-0.2-0.6-0.4-1.3-0.6-2.1
                        c-0.2,0.7-0.4,1.4-0.6,2.1s-0.4,1.2-0.6,1.7L205.4,33z'/>
                        <path class='st1' d='M235.9,45H230V13.2h5.9V45z'/>
                        <path class='st1' d='M265,37.5c0.3,0,0.6,0.1,0.8,0.4l2.3,2.5c-1.3,1.6-2.9,2.8-4.8,3.7s-4.1,1.3-6.8,1.3c-2.4,0-4.5-0.4-6.4-1.2
                        c-1.9-0.8-3.5-1.9-4.8-3.4s-2.4-3.2-3.1-5.1c-0.7-2-1.1-4.2-1.1-6.5c0-2.4,0.4-4.6,1.2-6.6c0.8-2,1.9-3.7,3.3-5.1
                        c1.4-1.4,3.2-2.6,5.2-3.4s4.2-1.2,6.6-1.2c2.4,0,4.4,0.4,6.2,1.1c1.8,0.8,3.3,1.8,4.5,3l-2,2.8c-0.1,0.2-0.3,0.3-0.5,0.5
                        c-0.2,0.1-0.4,0.2-0.8,0.2c-0.3,0-0.7-0.1-1-0.4c-0.4-0.3-0.8-0.6-1.3-0.9c-0.5-0.3-1.2-0.6-2.1-0.9c-0.8-0.3-1.9-0.4-3.2-0.4
                        c-1.5,0-2.9,0.3-4.1,0.8s-2.3,1.3-3.2,2.2c-0.9,1-1.6,2.1-2.1,3.5c-0.5,1.4-0.8,2.9-0.8,4.7c0,1.8,0.3,3.4,0.8,4.8
                        c0.5,1.4,1.2,2.6,2.1,3.5c0.9,1,1.9,1.7,3.1,2.2s2.4,0.8,3.8,0.8c0.8,0,1.5,0,2.2-0.1c0.7-0.1,1.3-0.2,1.8-0.4s1.1-0.4,1.6-0.7
                        c0.5-0.3,1-0.7,1.5-1.1c0.1-0.1,0.3-0.2,0.5-0.3C264.6,37.5,264.8,37.5,265,37.5z'/>
                        <path class='st1' d='M292.7,13.2v4.7h-14.1v8.8h11.1v4.6h-11.1v9h14.1V45h-20.1V13.2H292.7z'/>
                        <path class='st1' d='M314.8,19c-0.2,0.3-0.3,0.6-0.6,0.7c-0.2,0.1-0.5,0.2-0.8,0.2c-0.3,0-0.6-0.1-1-0.3c-0.4-0.2-0.8-0.5-1.3-0.8
                        c-0.5-0.3-1.1-0.5-1.7-0.8c-0.7-0.2-1.5-0.3-2.4-0.3c-0.8,0-1.5,0.1-2.1,0.3s-1.1,0.5-1.5,0.8c-0.4,0.4-0.7,0.8-0.9,1.3
                        c-0.2,0.5-0.3,1-0.3,1.6c0,0.7,0.2,1.4,0.6,1.9c0.4,0.5,1,0.9,1.7,1.3c0.7,0.4,1.5,0.7,2.4,0.9s1.8,0.6,2.7,0.9
                        c0.9,0.3,1.8,0.7,2.7,1.1s1.7,0.9,2.4,1.6c0.7,0.6,1.2,1.4,1.7,2.3s0.6,2,0.6,3.4c0,1.4-0.2,2.8-0.7,4s-1.2,2.3-2.2,3.3
                        c-0.9,0.9-2.1,1.7-3.5,2.2s-2.9,0.8-4.7,0.8c-1,0-2-0.1-3-0.3c-1-0.2-1.9-0.5-2.8-0.8c-0.9-0.4-1.7-0.8-2.5-1.3
                        c-0.8-0.5-1.5-1.1-2.1-1.7l1.7-2.8c0.2-0.2,0.4-0.4,0.6-0.5s0.5-0.2,0.8-0.2c0.4,0,0.8,0.2,1.2,0.5c0.4,0.3,0.9,0.6,1.5,1
                        c0.6,0.4,1.3,0.7,2,1c0.8,0.3,1.7,0.5,2.8,0.5c1.7,0,3-0.4,3.9-1.2c0.9-0.8,1.4-1.9,1.4-3.4c0-0.8-0.2-1.5-0.6-2
                        c-0.4-0.5-1-1-1.7-1.3s-1.5-0.7-2.4-0.9s-1.8-0.5-2.7-0.8c-0.9-0.3-1.8-0.6-2.7-1.1c-0.9-0.4-1.7-0.9-2.4-1.6
                        c-0.7-0.7-1.2-1.5-1.7-2.5s-0.6-2.2-0.6-3.7c0-1.2,0.2-2.3,0.7-3.4c0.5-1.1,1.1-2.1,2-2.9c0.9-0.9,2-1.5,3.3-2
                        c1.3-0.5,2.8-0.8,4.4-0.8c1.9,0,3.6,0.3,5.2,0.9c1.6,0.6,2.9,1.4,4,2.5L314.8,19z'/></g>
                    </svg>
                    <h2 font-size='25px' font-weight='500' line-height='25px'>¡Gracias por ponerte en contacto!</h2>
                    <p>Hola, " . ucfirst($respuestas['nombre']) . ", te pusiste en contacto por <span>". $respuestas['opciones'] . "</span> de un proyecto.</p>
                    <p>Correo: " . $respuestas['email'] . "</p>
                    <p>Telefono: " . $respuestas['telefono'] . "</p>
                    <p>Mensaje: " . $mensaje . "</p>
                    <p>". $opcion . ': ' . "$" . number_format(intval($respuestas['presupuesto']), 0, ",", ".") . "</p>
                    <p>Forma de contacto: " . ucfirst($respuestas['contacto']) . "</p>
                    <p>Disponibilidad: " . $disponibilidad . "</p>
                    <p>Te invitamos a estar pendiente a tu " . ucfirst($respuestas['contacto']) . "</p>
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