<?php

class Procedures extends Controller{

    public $typeForm;

    public function __construct(){
        parent::__construct();
    }
    
    public function render(){
        $this->view->render("procedures/index");
    }

    public function setTypeForm($type){
        $this->typeForm = $type;
    }

    public function getTypeForm(){
        return $this->typeForm;
    }

    /**
     * A static method that checks if still can register
     * @return { boolean } true if still yet passed the end date
     */
    public static function canStillRegister(){
        $currentDate = new DateTime(strftime('%y-%m-%d'));

        $endDateConfig = constant("CONFIG")["dates"]["endDate"];
        $endDate = new DateTime(
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

    /**
     * 
     */
    public static function error($message){
        require_once("manageError.php");
        $err = new ManageError($message);
        die();
    }

    public function setSession($params = null){

        if($params != null){
            if(count($params) === 3){
                $typeForm = $this->desinfect($params[0]);
                $campus = $this->desinfect($params[1]);
                $user = $this->desinfect($params[2]);
            }else{
                if(count($params) < 3){
                    $message = "Faltan parametros en esta consulta";
                }else{
                    $message = "Demasiados parametros ingresados";
                }
                Procedures::error($message);
            }
        }else{
            if(!empty($_POST)){
                $typeForm = $this->desinfect($_POST['typeForm']);
                $justLogin = (boolean) (int) $this->desinfect($_POST['justLogin']);
                $campus = $this->desinfect($_POST['campus']);
                $user = $this->desinfect($_POST['user']);
            }else{
                Procedures::error("Acceso denegado", true);
            }
        } 

        if(($typeForm === "regist" || $typeForm == "login") && App::varValidate($user, $campus)){

            $this->setCampus($campus);
            $this->setTypeOfUser($user);

            $include = "";
            $validated = App::varValidate($_SESSION['campus'],$_SESSION['user'],$_SESSION['username']);

            if($typeForm == "login" || (isset($justLogin) and !$justLogin)){
                $include .= "login/" . $user;
            }else{
                if($validated){
                    $this->prepareStudentRegistInfo();
                    $this->view->colleges = $this->getColleges("normal");
                    $include .= "regist/" . $user;
                }else{
                    print("<script>
                            alert('acceso denegado');
                            window.history.back();
                           </script>");
                }
            }

            $this->setTypeForm($typeForm);
            $this->showForm($include);
        }else{
            Procedoures::error("El formulario al que intenta acceder 
            no existe o no esta disponible, vuelva en otro momento.");
        }
    }

    protected function showForm(string $path){
        $finalPath = "structure/views/procedures/" . $path . ".php";
        $this->view->form = $finalPath;
        $this->render();
    }

    private function prepareStudentRegistInfo(){
        $student= new Student();
        $student->name = $this->getUserName();
        $student->nocta = $this->getUser();
        $student->grade = null;
        $student->group = null;
        $student->bornDate = null;

        $additionalInfo = $this->model->getGroupAndDate($this->getUser());

        if($additionalInfo->success){

            $student->group = $additionalInfo->data["group"];
            $student->bornDate = $additionalInfo->data["bornDate"];

            if(is_numeric(substr("$student->group",-1,1))){
				$rest = substr("$student->group", -3, 1);
			}else{
				$rest = substr("$student->group", -4, 1);
			}

			// if($rest == 6){$grado = 6;$gradoE = "6°";}
            // elseif($rest == 5){$grado = 5;$gradoE = "5°";}
            // else{$grado = 4;$gradoE = "4°";}

            $student->grade = $rest;
        }else{
            //error para cuando falle la consulta
            Procedures::error($additionalInfo->errors);
        }

        $this->view->student = $student;
    }

    /**
     * @param { string } $format, the format in which the data will be returned, json format by defect.
     */
    public function getColleges($format = 'json'){
        $modelHandler = $this->model->getColleges();
        $format = strtolower($format);
        if($format === "json"){
            echo json_encode($modelHandler);
        }else if($format == "normal"){
            return $modelHandler->data;
        }
    }

    public function getOneCollege($id){

        $colleges = $this->getColleges('normal');
        if(count(str_split($id)) == 1){
            $id = '0' . $id;
        }
        $res = "error";
        foreach($colleges as $key => $col){
            if($col["id"] == $id){
                $res = $col["name"];
                break;
            }
        }
        return $res;
    }

    /**
     * @param { string } $college_ID, the id college of the respective subject.
     */
    public function getSubjects($college_ID, $format = "json"){
        $college_ID = (int) $this->desinfect($college_ID[0]);
        $subjects = $this->model->getSubjects($college_ID);
        if($format == "json"){
            echo json_encode($subjects);
        }else if($format == 'normal'){
            return $subjects->data;
        }
    }

    public function getOneSubject($college_ID, $subject_id){
        if(count(str_split($college_ID)) == 1){ $college_ID = '0' . $college_ID; }
        $college_ID = [$college_ID];
        $subjects = $this->getSubjects($college_ID, 'normal');

        $res = "error";
        foreach($subjects as $key => $sub){
            if($sub["id"] == $subject_id){
                $res = $sub["name"];
                break;
            }
        }
        return $res;
    }

    /**
     * @param { Array } $ids, An array that should have the followed data:
     *      [0] => The id of the college
     *      [1] => The id of the subject 
     */
    public function getProfesors($ids, $format = "json"){
        $college_id = (int) $this->desinfect($ids[0]);

        $profesors = null;

        if(isset($ids[1])){
            $subject_id = $this->desinfect($ids[1]);
            $profesors = $this->model->getProfesorsBySubject($subject_id);
        }else{
            $profesors = $this->model->getProfesorsByCollege($college_id);
        }

        if($format == "json"){
            echo json_encode($profesors);
        }else if($format == "normal"){
            return $profesors->data;
        }
    }

    public function getOneProfesor($col, $sub, $prof){
        $profesors = $this->getProfesors([$col, $sub],"normal");
        $res = "error";
        foreach($profesors as $key => $value){
            if($value["rfc"] == $prof){
                $res = $value["name"];
                break;
            }
        }
        return $res;
    }



    public function loginStudent(){

        $res = new ServiceResult();

        $nocta = (int) $this->desinfect($_POST['account']);
        $pass = $this->desinfect($_POST['pass']);

        //verify that the user exists 
        $loginHandler = $this->model->consultStudentIsSignedUp($nocta, $pass);
        if($loginHandler->success){
            //verify the user is registered
            $registHandler = $this->model->consultRegist($nocta);
            if($registHandler->success){
                //the user is registered

                //setting the session variables
                $this->setUser($nocta);
                $this->setUserName($loginHandler->data);

                $res->success = true;
                $res->onSuccessEvent = constant("CONFIG")["url"] . "home/student";//send it home
            }else{
                //the user isn't registered
                if($registHandler->errors === 1){

                    $this->setUser($nocta);
                    $this->setUserName($loginHandler->data);
                    
                    $res->errors = 202;
                    $res->message = $registHandler->message;
                    $res->onSuccessEvent = constant("CONFIG")["url"] . "procedures/setSession/regist/" . $this->getCampus() . "/student";
                
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
                    $res->message = "Error 500: hubo un error inesperado, intente volver más tarde";
                    break;
            }
        }
        echo json_encode($res);
    }

    public function loginProfesors(){
        $res = new ServiceResult();

        $rfc = $this->desinfect($_POST['rfc']);
        $pass = $this->desinfect($_POST['pass']);

        $loginHandler = $this->model->consultProfesorIsSignedUp($rfc, $pass);

        $res->data = $_POST;
        echo json_encode($res);
    }

    public function registStudent(){
        $res = new ServiceResult();

        $shouldBeRecived = ['name', 'bornDate', 'accaunt', 'grade', 'group','turn', 'reason',
                    'college', 'subject', 'profesor', 'street', 'colony', 'townHall',
                    'postalCode', 'city', 'tutor', 'mobil', 'phone', 'email'];//and photo
        $data = [];
        $count = 0;

        //the reason of the second condition inside while loop is to prevent an attack of infinity $_POST data.
        while($_POST && $count < count($shouldBeRecived)){
            //here is validated the data.
            $valName = $shouldBeRecived[$count];
            $validating = $this->desinfect($_POST[$valName]);
            if(App::varValidate($validating)){
                $data[$valName] = $validating;
            }else{
                $res->errors = "Missing data";
                $res->messages = "El campo '$valName' ha sido llenado incorrectamente.";
                break;
            }
            $count++;
        }

        if(count($data) === count($shouldBeRecived)){

            $searchExistingRegistry = $this->model->searchExistingRegistry($data['accaunt'], 'nocta', 'students');
            if($searchExistingRegistry->success){
                if(!$searchExistingRegistry->data){
                    $studentsRegistered = $this->model->countStudentsRegistered($data["profesor"]);
                    if($studentsRegistered->success){
                        if($studentsRegistered->data <= (int) constant("CONFIG")["quantities"]["studPerTeacher"]){
                            //setting the data
                            $registry = new Student();

                            $registry->setName($data["name"]);
                            $registry->setBornDate($data["bornDate"]);
                            $registry->setAccaunt($data["accaunt"]);
                            $registry->setGrade($data["grade"]);
                            $registry->setGroup($data["group"]);
                            $registry->setTurn($data["turn"]);
                            $registry->setReason($data["reason"]);
                            $registry->setCollege($data["college"]);
                            $registry->setSubject($data["subject"]);
                            $registry->setProfesor($data["profesor"]);
                            $registry->setStreet($data["street"]);
                            $registry->setColony($data["colony"]);
                            $registry->setTownHall($data["townHall"]);
                            $registry->setPostalCode($data["postalCode"]);
                            $registry->setCity($data["city"]);
                            $registry->setTutor($data["tutor"]);
                            $registry->setMobil($data["mobil"]);
                            $registry->setPhone($data["phone"]);
                            $registry->setEmail($data["email"]);
                            $registry->setRegistrationDate(strftime("%y-%m-%d %H:%M"));

                            //setting the photo data
                            $settingPhoto = $registry->setPhoto($_FILES['photo']);
                            if($settingPhoto["success"]){
                                $registHandler = $this->model->registStudent($registry);
                                if($registHandler->success){
                                    $res->success = true;
                                    $res->onSuccessEvent = constant("CONFIG")["url"] . "home/student";
                                }else{
                                    $res->errors = $registHandler->errors;
                                    $res->messages = "No se logro completar correctamente el registro";
                                }
                            }else{
                                $res->errors = 0;
                                $res->messages = $settingPhoto["errors"];
                            }
                        }else{
                            $res->errors = 0;
                            $res->messages = "Ya no hay disponibilidad de registro con este profesor, intenta con otro.";
                        }
                    }else{
                        $res->errors = $studentsRegistered->errors;
                        $res->messages = "Hubo un error al consultar la disponibilidad con este profesor";
                    }
                }else{
                    //in case the user is already registered
                    $res->errors = 0;
                    $res->messages = "Ya te has registrado al programa";
                }
            }else{
                $res->errors = $searchExistingRegistry->errors;
                $res->messages = "Algo salio mal durante la busqueda de registros";
                //case the search existing registry process faild, drop a message error for the user.
            }
        }else{
            $res->errors = 0;
            $res->messages = "Los datos no fueron correctamente procesados";
        }
        
        echo json_encode($res);
    }
}