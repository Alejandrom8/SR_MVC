<?php 

require_once('manageError.php');

class Admon extends Controller{
    public function __construct(){
        parent::__construct();
    }

    public function init(){
        if(App::varValidate($this->getUser(), $this->getCampus(),$this->getTypeOfUser())){
            $campus = $this->model->getCampus();
            $this->view->campus = $campus->data;
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
        echo json_encode($this->model->generalCount($campus->data));
    }

    public function searcher(){
        echo json_encode($_REQUEST);
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
}