<?php 

class Welcome extends Controller{
    public function __construct(){
        parent::__construct();
    }
    public function render(){
        $this->view->render("welcome/index");
    }

    public function setUserSchool(){
        if(!empty($_POST)){
            $school = (int) $this->desinfect($_POST['plantel']);
            $_SESSION['school'] = $school;
            echo $_SESSION['school'];
        }
    }
}

?>