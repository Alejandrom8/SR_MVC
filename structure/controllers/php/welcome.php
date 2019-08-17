<?php 

include_once("procedures.php");

class Welcome extends Controller{

    protected $prueba;
    
    public function __construct(){
        parent::__construct();
        $this->view->registredCampus = null;

        $canStillRegister = Procedures::canStillRegister();

        $registOption = '<button class="form-handler btn btn-secondary btn-sm btn-block" name="typeForm" value="regist">Registrate</button>';
        $noRegist = '
            <div class="alert alert-warning">El periodo de registro para el año 2019 ha terminado</div>
            <button class="form-handler btn btn-secondary btn-sm btn-block" name="typeForm" value="regist" disabled>Registrate</button>
        ';

        $this->view->registOption = $canStillRegister ? $registOption : $noRegist;
        
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
