<?php 
setlocale(LC_TIME, "es_MX.UTF-8");
date_default_timezone_set("America/Mexico_City");

// $config = json_decode(file_get_contents("config/config.json"), true);//the configuration of the app
// $dict = json_decode(file_get_contents("config/dictionary.json"), true);//A dictionary. the fetch associative that let know wich is the value of one number in the app.
// define("CONFIG", $config);
// define("_DICT_", $dict);

const LOCAL = "http://127.0.0.1/";
const URL = "http://127.0.0.1/SR_MVC/";
const photoPath = "http://127.0.0.1/srjhiData/fotos/";
const adminPass = "";
const databases = [
    "user" => "root",
    "password" => "Alejandrom8",
    "host" => "localhost",
    "charset" => [
        "prepa_8_charset" => "utf8"
    ]
];
const quantities = [
    "studPerTeacher" => 20,
    "photoSize" => 4194304,
    "daysBeforeWarning" => 5 
];
const dates = [
    "startDate" => [
        "day" => 29,
        "month" => 12,
        "year" => 18
    ],
    "endDate" => [
        "day" => 26,
        "month" => 8,
        "year" => 21
    ]
];
const campus = [
    "p8"=>[
        "plantel"=>8,
        "nombre"=> "MIGUEL E. SCHULZ"
    ]
];

const dictionary = [
    "turn"=> [
        "0"=> "matutino",
        "1"=> "vespertino",
        "2"=> "mixto"
    ],
    "reason"=> [
        "0"=> "reinscripción",
        "1"=> "inscripción"
    ]
];

//carpetas
define("PHOTO_FOLDER", $_SERVER['DOCUMENT_ROOT'] . "/srjhiData/fotos/");

