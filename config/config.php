<?php 
setlocale(LC_TIME, "es_MX.UTF-8");
date_default_timezone_set("America/Mexico_City");

$config = json_decode(file_get_contents("config/config.json"), true);//the configuration of the app
$dict = json_decode(file_get_contents("config/dictionary.json"), true);//A dictionary. the fetch associative that let know wich is the value of one number in the app.
define("CONFIG", $config);
define("_DICT_", $dict);
//carpetas
define("PHOTO_FOLDER", $_SERVER['DOCUMENT_ROOT'] . "/srjhiData/fotos/");

