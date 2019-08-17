<?php 

class Controller{

    public function __construct(){
        $this->view = new View();
    }
    
    public function loadModel(string $controller){
        $modelName = $controller . "Model";
        $url_model = 'structure/models/' . $modelName . '.php';
        if(file_exists($url_model)){
            require_once($url_model);
            $this->model = new $modelName();
        }
    }

    public function desinfect($data){
        /*  funcion para evaluar cada dato que entre al servidor
        *  y quitar caracteres especiales para más seguridad
        * @access public
        * @param String,int,boolean,etc. $data dato al que se le quitaran caractres especiales
        * @return $data dato sin caracteres especiales.
        */
        // $data = preg_replace('([^A-Za-z0-9._@-])', '', $data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    protected function setCampus($campus){
        $_SESSION['campus'] = $this->desinfect($campus);
    }

    protected function getCampus(){
        return $_SESSION['campus'];
    }

    protected function setTypeOfUser($type){
        $_SESSION['typeOfUser'] = $this->desinfect($type);
    }

    protected function getTypeOfUser(){
        return $_SESSION['typeOfUser'];
    }

    protected function setUser($user){
        $_SESSION['user'] = $this->desinfect($user);
    }

    protected function getUser(){
        return $_SESSION['user'];
    }

    protected function setUserName($name){
        $_SESSION['username'] = $this->desinfect($name);
    }

    protected function getUserName(){
        return $_SESSION['username'];
    }
}

?>