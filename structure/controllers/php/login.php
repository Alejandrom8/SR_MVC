<?php 

class Login extends Controller{
    
    public function __construct(){
        parent::__construct();
    }

    private function getSchoolName($id){
        $id = $this->desinfect($id);
        $consultName = $this->model->getSchoolName($id);
        if($consultName->success){
            return $consultName->data;
        }else{
            return null;
        }
    }

    /**
     * A static method that checks if still can register
     * @return { boolean } true if still yet passed the end date
     */
    private static function canStillRegister(){
        $currentDate = strftime('%y-%m-%d');

        $endDateConfig = constant("CONFIG")["dates"]["endDate"];
        $endDate = strtotime(
            $endDateConfig["year"] . '-' .
            $endDateConfig["month"] . '-' . 
            $endDateConfig["day"]
        );

        if($currentDate > $endDate){
            return false;
        }else{
            return true;
        }
    }

    public function setUserSchool($params){
        $campus = $params[0];
        $res = new ServiceResult();
        $school = (int) $this->desinfect($campus);
        $_SESSION['school'] = $school;
        // $schoolName = $this->getSchoolName($_SESSION['school']);
        $res->success = true;
        $res->data = $_SESSION["school"];
        echo json_encode($res);
    }

    public function loginAlumno($param){

        $res = new ServiceResult();

        $data = isset($param) ? $param : $_POST;

        $nocta = $this->desinfect($data['nocta']);
        $pass = $this->desinfect($data['password']);
        //El usuario existe ? 
        $theUserCanSignIn = $this->model->consultUser($nocta, $pass);
        if($theUserCanSignIn->success){
            //El usuario esta registrado ?
            $theUserIsRegistred = $this->model->consultRegist($nocta);
            if($theUserIsRegistred->success){
                $res->success = true;
                $res->onSuccessEvent = constant('URL') . "home";
                $_SESSION['user'] = $nocta;
            }else{
                //el usuario no esta registrado
                if($theUserIsRegistred->errors === 1){
                    $res->errors = 0;
                    $res->message = $theUserIsRegistred->message;
                    if($this->sePuedeRegistrar()){
                        $res->onErrorEvent = "open_window_alumno";
                    }
                    //programar mensage para cuando ya no se puede registrar
                }else{
                    $res->errors = $theUserIsRegistred->errors;
                }
            }
        }else{
            switch($theUserCanSignIn->errors){
                case 1:
                    $res->errors = 0;
                    $res->message = "Usuario incorrecto";
                    break;
                case 2:
                    $res->errors = 0;
                    $res->message = "contraseña incorrecta";
                    break;
                default:
                    $res->errors = $theUserCanSignIn->errors;
                    break;
            }
        }

        echo json_encode($res);
    }

    public function loginProfesor(){
        $res = new ServiceResult();
        if(!empty($_POST)){
            $rfc = $this->desinfect($_POST['rfc']);
            $pass = $this->desinfect($_POST['pass']);
        }
        echo json_encode($res);
    }
}

?>