<?php
class ManageError extends Controller{
    public $message;
    public function __construct($message = "hubo un error inesperado o la seccion a la que intent entrar no existe"){
        parent::__construct();
        $this->view->message = $message;
        // print("<script>alert('Error: " . $this->$message . "');window.history.back();</script>");
        // return false;
    }
    public function render(){
        $this->view->render("error/index");
    }
}
?>