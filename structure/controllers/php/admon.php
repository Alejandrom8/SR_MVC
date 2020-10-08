<?php 

require_once('manageError.php');

class Admon extends Controller{
    public function __construct(){
        parent::__construct();
    }

    public function init(){
        if(App::varValidate($this->getUser(), $this->getCampus(),$this->getTypeOfUser())){
            //Not registered campus
            $campus = $this->model->getCampus();
            $this->view->campus = $campus->data;
            $this->view->registeredCampus = constant("campus");
            //Getting the geeral statistics data
            // $this->view->byTurn = ($this->model->byTurn($this->registeredCampus))->data;
            $this->render();
        }else{
            $this->prepareLogin();
        }
    }

    public function render(){
        $this->view->render("admon/home");
    }

    private function prepareLogin(){
        require_once('procedures.php');

        $pro = new procedures();
        $this->loadModel('procedures');

        $pro->setSession([
            "login",
            "any",
            "admon"
        ]);
    }

    public function countGeneralData(){
        require_once("procedures.php");
        $pro = new Procedures();
        $pro->loadModel('procedures');
        $campus = $pro->registeredCampus();
        $this->registeredCampus = $campus->data;
        $registeredCampus = $this->model->generalCount($campus->data);
        // $this->view->generalStatistics = $registeredCampus->data;
        echo json_encode($registeredCampus);
    }

    public function searcher(){
        echo json_encode($_REQUEST);
    }

    public function createDataBase(){
        $res = new ServiceResult();
        $campus = $this->desinfect($_POST["campus"]);
        $handler = $this->model->makeDataBase($campus);
        if($handler->success){  
            $res->success = true;
            $res->messages = ["Se ha creado la base de datos para el campus."];
        }else{
            $res->errors = $handler->errors;
            $res->messages = ["No logro crearse la base de datos"];
        }
        echo json_encode($res);
    }

    public function registCalifTable(){
        $res = new ServiceResult();
        $res->messages = [];
        $permitedTypes = ["application/sql"];

        $file = $_FILES["califTable"];
        $campus = $this->desinfect($_POST["campus"]);

        if($file != null and in_array($file["type"], $permitedTypes)){
            $tableName = "p" . $campus . "_calif";
            array_push($res->messages, "Archivo ". $file["name"] ." verificado");
            $verify = $this->model->verifyThatNotExists($tableName);
            if($verify->data){
                $result = $this->model->executeThat($file["tmp_name"], $tableName);
                array_push($res->messages, $result->messages);
                if($result->success){
                    $res->success = true;
                    array_push($res->messages, "Se subio correctamente la tabla de alumnos con el archivo " . $files["name"]);
                }else{
                    $res->errors = $result->errors;
                    array_push($res->messages, "No se logro subir la tabla con el archivo dado.");
                }
            }else{
                $res->success = true;
                $res->errors = $verify->errors;
                array_push($res->messages, "La tabla de alumnos ya existe para este plantel por lo que no se alterara ninguna fila.");
            }
        }else{
            array_push($res->messages, "No se subio ningún archivo valido para la tabla de alumnos");
        }
        echo json_encode($res);
    }

    public function registHorariosTable(){
        $res = new ServiceResult();
        $res->messages = [];
        $permitedTypes = ["application/sql"];

        $file = $_FILES["horariosTable"];
        $campus = $this->desinfect($_POST["campus"]);

        if($file != null and in_array($file["type"], $permitedTypes)){
            $tableName = "p" . $campus . "_horarios";
            array_push($res->messages, "Archivo ". $file["name"] ." verificado");
            $verify = $this->model->verifyThatNotExists($tableName);
            if($verify->data){
                $result = $this->model->executeThat($file["tmp_name"], $tableName);
                array_push($res->messages, $result->messages);
                if($result->success){
                    $res->success = true;
                    array_push($res->messages, "Se subio correctamente la tabla de profesores con el archivo " . $files["name"]);
                }else{
                    $res->errors = $result->errors;
                    array_push($res->messages, "No se logro subir la tabla con el archivo dado.");
                }
            }else{
                $res->success = true;
                $res->errors = $verify;
                array_push($res->messages, "La tabla de profesores ya existe para este plantel por lo que no se alterara ninguna fila.");
            }
        }else{
            array_push($res->messages, "No se subio ningún archivo valido para la tabla de alumnos");
        }
        echo json_encode($res);
    }

    public function makeFolders(){
        $res = new ServiceResult();

        $res->messages = [];

        $campus = $this->desinfect($_POST["campus"]);
        $folderName = "p" . $campus;
        $path = constant("PHOTO_FOLDER");
        $finalPath = $path . $folderName;

        array_push($res->messages, "Se intentara crear la carpeta para las fotos en la ruta: " . $finalPath);

        try{
            if ( !file_exists( $finalPath ) && !is_dir( $finalPath ) ) {
                mkdir($finalPath);
                array_push($res->messages, "La carpeta para las fotos del plantel se creo exitosamente");
            }else{
                array_push($res->messages, "La carpeta de fotos ya existia, por lo que se ha omitido este paso.");
            }
            $res->success = true;
        }catch(Exception $e){
            $res->errors = $e;
            array_push($res->messages, "Hubo un error al crear la carpeta de las fotos para el plantel");
        }

        echo json_encode($res);
    }

    public function makeTables(){
        $res = new ServiceResult();
        $res->messages = [];
        $campus = $this->desinfect($_POST["campus"]);
        $statusStudentTable = $this->model->createStudentsTable($campus);
        if($statusStudentTable->success){
            $statusProfesorsTable = $this->model->createProfesorsTable($campus);
            if($statusProfesorsTable->success){
                $res->success = true;
                array_push($res->messages,"Se crearon las tablas para el registro de alumnos y profesores");
            }else{
                $res->errors = $statusProfesorsTable->errors;
                array_push($res->messages,"No logro crearse la tabla para el registro de los profesores");
            }
        }else{
            $res->errors = $statusStudentTable->errors;
            array_push($res->messages,"No logro crearse la tabla para el registro de los alumnos");
        }
        echo json_encode($res);
    }

    public function setRegistered(){
        $res = new ServiceResult();
        $campus = $this->desinfect($_POST["campus"]);
        $handler = $this->model->setRegisteredCampus($campus);
        if($handler->success){
            $res->messages = ["Se ha cambiado el estado del plante a 'Activo'"];
        }else{
            $res->errors = $handler->errors;
            $res->messages = ["No se ha logrado colocar el estado del plantel como 'Activo'"];
        }
        echo json_encode($res);
    }

    /**
     * @param {array} $params : Just with two values, the campus that wants the user get
     */
    public function getAllTheStudents($params){
        if(isset($params)){
            if($params[1] == "s"){
                $campus = $params[0];
                $getter = $this->model->getAllTheStudentsRegistered($campus);
            }else{
                $res = new ServiceResult();
                $res->messages = [];
                $campus = constant("campus");
                $studentsPerCampus = [];
                foreach($campus as $key => $c){
                    $students = $this->model->getAllTheStudentsRegistered($c["plantel"]);
                    if(!$students->success){
                        array_push($res->messages, $students->errors);
                    }else{
                        $result = ["campus" => $c["plantel"], "students" => $students->data];
                        array_push($studentsPerCampus, $result);
                    }
                }
                $res->data = $studentsPerCampus;
                $res->messages = App::makeItLegible($res->messages);
                $res->success = true;
                $getter = $res;
            }
            echo json_encode($getter);
        }
    }

    public function getAllTheProfesorsAndStudents($params){
        if(isset($params)){
            $res = new ServiceResult();
            $res->messages = [];
            $res->errors = [];

            if($params[1] == "s"){
                $campus = $params[0];
                $profesors =  $this->model->getAlltheProfesors($campus);
                if($profesors->success){
                    $result = [];
                    foreach($profesors->data as $prof){
                        $stds = $this->model->getStudentsPerProfesor($campus, $prof["rfc"]);
                        if($stds->success){
                            $insert = [
                                "nombre" => $prof["nombre"],
                                "rfc" => $prof["rfc"],
                                "students" => $stds->data
                            ];
                            array_push($result, $insert);
                        }else{
                            array_push($res->messages, $stds->errors);
                        }
                    }
                    $res->data = $result;
                    $res->success = true;
                }else{
                    array_push($res->errors, $profesor->errors);
                    array_push($res->messages, "Problema obteniendo los profesores de este plantel");
                    //do something if the profesors consult breaks
                }
                $res->errors = App::makeItLegible($res->errors);
                $res->messges = App::makeItLegible($res->messages);
            }else{
                $campus = constant("campus");
                $result = [];

                foreach($campus as $key => $c){
                    $profesors =  $this->model->getAlltheProfesors($c["plantel"]);
                    if($profesors->success){
                        $partialResult = [];
                        foreach($profesors->data as $prof){
                            $stds = $this->model->getStudentsPerProfesor($c["plantel"], $prof["rfc"]);
                            if($stds->success){
                                $insert = [
                                    "nombre" => $prof["nombre"],
                                    "rfc" => $prof["rfc"],
                                    "students" => $stds->data
                                ];
                                array_push($partialResult, $insert);
                            }else{
                                array_push($res->messages, $stds->errors);
                            }
                        }
                        $campus = ["campus" => $c["plantel"], "data" => $partialResult];
                        array_push($result, $campus);
                    }else{
                        array_push($res->errors, $profesor->errors);
                        array_push($res->messages, "Problema obteniendo los profesores de este plantel");
                    }
                }

                $res->data = $result;
                $res->errors = App::makeItLegible($res->errors);
                $res->messages = App::makeItLegible($res->messages);
                $res->success = true;
            }
            
            echo json_encode($res);
        }
    }

    public function countAllByTurn(){
        $totals = $this->model->countByTurn();
        echo json_encode($totals, JSON_UNESCAPED_UNICODE);
    }
}