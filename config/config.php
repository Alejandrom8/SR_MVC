<?php 
setlocale(LC_TIME, "es_MX.UTF-8");
date_default_timezone_set("America/Mexico_City");

//url
define("LOCAL", "http://localhost/");
define("URL", constant("LOCAL") . "welcome/");
define("URL_FOTOS", constant("LOCAL") . "userData/");
//base de datos

//rutas

//cantidades
define("MAX_ALUMN_REGIST", 20); //alumnos por profesor
define('MAX_FOTO_SIZE', 50000000); //6.25 MB
//fechas
define("FECHA_DE_INICIO", [29, 12, 2019]);
define("FECHA_DE_CIERRE", [29, 12, 2019]);
//estado
define("ESTADO", true);
//carpetas
define("CARPETA_FOTOS", $_SERVER['DOCUMENT_ROOT'] . "/SR/userData/");
?>