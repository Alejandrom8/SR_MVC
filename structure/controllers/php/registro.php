<?php 
require_once("login.php");

class Registro extends Controller{
    public function __construct(){
        parent::__construct();
    }

    public function render(){
        $this->view->render("registro/index");
    }

    public function registrarAlumno(){
        $data = [    

            "nocta" => $_POST['nocta'],
            "password" => $_POST['user_key']
        ];

        $login = new Login();
        $result = $login->loginAlumno($data);
        var_dump($result);
        die();
    }
}

?>