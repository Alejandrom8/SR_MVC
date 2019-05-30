<?php 
setlocale(LC_TIME, "es_MX.UTF-8");
date_default_timezone_set("America/Mexico_City");

//url
define("LOCAL", "http://localhost/");
define("URL", constant("LOCAL") . "SR_MVC/");
define("URL_FOTOS", constant("LOCAL") . "userData/");
//base de datos
define("USER", "root");
define("PASSWORD", "Alejandrom8");
define("HOST", "localhost");

    define("prepa_1_charset", "utf8");
    define("prepa_2_charset", "utf8");
    define("prepa_3_charset", "utf8");
    define("prepa_4_charset", "utf8");
    define("prepa_5_charset", "utf8");
    define("prepa_6_charset", "utf8");
    define("prepa_7_charset", "utf8");
    define("prepa_8_charset", "utf8");
    define("prepa_9_charset", "utf8");

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