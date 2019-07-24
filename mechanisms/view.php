<?php
class View {
    public function __construct(){

    }
    public function render($file){
        require_once('structure/views/' . $file . '.php');
    }
}
?>