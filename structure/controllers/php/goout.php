<?php

class Goout extends Controller{
    public function __construct(){
        parent::__construct();
        Goout::out(true);
    }

    public  static function out($verbose = false){
        if($verbose){
            echo "Espere un momento porfavor...";
        }
        foreach($_SESSION as $key => $value){
          $_SESSION[$key] = NULL;
        }
        session_destroy();
        if($verbose){
            print("<script>window.location = '" . constant("CONFIG")["url"] . "';</script>'");
        }
    }
}