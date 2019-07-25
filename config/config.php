<?php 
setlocale(LC_TIME, "es_MX.UTF-8");
date_default_timezone_set("America/Mexico_City");

$config = json_decode(file_get_contents("config/config.json"), true);
define("CONFIG", $config);
//carpetas
define("CARPETA_FOTOS", $_SERVER['DOCUMENT_ROOT'] . "/SR/userData/");

