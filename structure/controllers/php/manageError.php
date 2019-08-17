<?php
class ManageError extends Controller{
    public $message;
    public function __construct($message = "hubo un error inesperado o la sección a la que intent entrar no existe", $endSession = false){
        parent::__construct();
        $this->view->message = $message;
        if($endSession){
            require_once("goout.php");
            Goout::out();
        }
        $this->render();
    }
    public function render(){
        $this->view->render("error/index");
    }
}
