<?php

require __DIR__ . '/../vendor/autoload.php';
//Llama la dependencia de Dotenv
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
//Valida que si el archivo no existe, no genere error
$dotenv->safeLoad();
require 'funciones.php';
require 'config/database.php';


//Conectarnos a la base de datos
$db = conexionBD();

use Model\ActiveRecord;
ActiveRecord::setDB($db);  

