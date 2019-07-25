<?php

class Procedures extends Controller{
    public function __construct(){
        parent::__construct();
        $this->view->form = "structure/views/procedures/";
    }
    
    public function render(){
        $this->view->render("procedures/index");
    }

    public function setSession($params){
        $typeForm = $params[0];
        $campus = $params[1];
        $user = $params[2];

        $this->setCampus($campus);
        $this->setTypeOfUser($user);

        $include = "";

        if(($typeForm === "regist" || $typeForm == "login") && $user != null && $campus != null){
            $include .= $typeForm . "/" . $user . ".php"; 
            $this->view->form .= $include;
            $this->render();
        }else{
            require_once("manageError.php");
            $err = new ManageError("El formulario al que intenta acceder 
            no existe o no esta disponible, vuelva en otro momento.");
            $err->render();
        }
    }

    public function login(){
        $res = new ServiceResult();

        $nocta = (int) $this->desinfect($_POST['account']);
        $pass = $this->desinfect($_POST['pass']);

        //verify that the user exists 
        $loginHandler = $this->model->consultUser($nocta, $pass);
        if($loginHandler->success){
            //verify the user is registered
            $registHandler = $this->model->consultRegist($nocta);
            if($registHandler->success){
                //the user is registered
                $this->setUser($nocta);
                $res->success = true;
                $res->onSuccessEvent = constant("CONFIG")["url"] . "home";
            }else{
                //the user isn't registered
                if($registHandler->errors === 1){
                    $res->errors = 0;
                    $res->message = $registHandler->message;
                }else{
                    $res->errors = $registHandler->errors;
                }
            }
        }else{
            //the user doesn't exists
            switch($loginHandler->errors){
                case 1:
                    $res->errors = 0;
                    $res->message = "Usuario incorrecto";
                    break;
                case 2:
                    $res->errors = 0;
                    $res->message = "contraseña incorrecta";
                    break;
                default:
                    $res->errors = $loginHandler->errors;
                    $res->message = "Error 500: hubo un error, contacte al propietario de este servidor";
                    break;
            }
        }
        echo json_encode($res);
    }

    public function initSession($params){
        
    }
}