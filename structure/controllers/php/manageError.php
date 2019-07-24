<?php
class ManageError extends Controller{
    public $message;
    public function __construct($message = "hubo un error inesperado o la seccion a la que intent entrar no existe"){
        parent::__construct();
        $this->message = $message;
        echo $this->message;
        die();
        // print("<script>alert('Error: " . $this->$message . "');window.history.back();</script>");
        // return false;
    }
}
?>