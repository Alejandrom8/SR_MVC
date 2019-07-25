<?php 

class Welcome extends Controller{

    protected $prueba;
    
    public function __construct(){
        parent::__construct();
        $this->view->registredCampus = null;
        $this->askForRegistredCampus();
    }

    public function render(){
        $this->view->render("welcome/index");
    }

    public function askForRegistredCampus(){
        $options = constant("CONFIG")["campus"]["registredCampus"];
        $optionsHTML = "";
        foreach($options as $op){
            $campusID = $op["plantel"];
            $campusName = $op["nombre"];
            $optionsHTML .= "<option value='$campusID'>plantel #$campusID. $campusName</option>";
        }
        $this->view->registredCampus = $optionsHTML;
        $this->render();
    }
}

?>