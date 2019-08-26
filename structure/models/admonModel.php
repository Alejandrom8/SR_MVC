<?php

class AdmonModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function getCampusName($campus){
        $res = new ServiceResult();
        try{   
            $sql = "SELECT nombre FROM info WHERE clave = :id";
            $e = $this->connection->alfa()->prepare($sql);
            $e->bindParam(":id", $campus);
            $e->execute();
            $data = $e->fetch(PDO::FETCH_ASSOC);
            $name = $data["nombre"];
            $res->data = $name;
            $res->success = true;
        }catch(PDOException $e){
            $res->errors = $e;
        }finally{
            return $res;
        }
    }

    public function partialCount($campus, $table, $condition){
        $res = new ServiceResult();
        try{   
            $sql = "SELECT DISTINCT count(*) as total FROM $table WHERE $condition ORDER BY nombre ASC";
            $con = new Connection('srjhi_p' . $campus, "utf8");
            $e = $con->beta()->prepare($sql);
            $e->execute();
            $data = $e->fetch(PDO::FETCH_ASSOC);
            $total = $data["total"];
            $res->data = $total;
            $res->success = true;
            $e->closeCursor();
            $e = null;
        }catch(PDOException $e){
            $res->errors = $e;
        }finally{
            return $res;
        }
    }

    public function generalCount($campuses){
        $res = new ServiceResult();
        try{
            $res->data = [];
            $res->messages = [];
            foreach($campuses as $key => $campus){
                $students = $this->partialCount($campus["id"], "students", true);
                $profesors = $this->partialCount($campus["id"], "prof", true);
                if($students->success and $profesors->success){
                    $res->data["plantel_" . $campus["id"]] = [
                        "plantel" => $campus["id"],
                        "students" => $students->data,
                        "profesors" => $profesors->data
                    ];
                }else{
                    array_push($res->messages, $students->errors);
                    array_push($res->messages, $profesors->errors);
                }
            }
            $res->messages = App::makeItLegible($res->messages);
            $res->success = true;
        }catch(PDOException $e){
            $res->errors = $e;
        }finally{
            return $res;
        }
    }

    public function getCampus(){
        $res = new ServiceResult();
        try{    

            $sql = "SELECT clave,nombre FROM info WHERE registrado = 0 ORDER BY clave ASC";
            $e = $this->connection->alfa()->prepare($sql);
            $e->execute();
            $campus = [];
            while($row = $e->fetch(PDO::FETCH_ASSOC)){
                array_push($campus, ["id" => $row["clave"], "name" => $row["nombre"]]);
            }
            $res->data = $campus;
            $res->success = true;
            $e->closeCursor();
            $e = null;

        }catch(PDOException $e){
            $res->errors = $e;
        }finally{
            return $res;
        }
    }

    public function verifyThatNotExists($table){
        $res = new ServiceResult();
        try{
            $sql = "SHOW TABLES LIKE '". $table ."'";
            $e = $this->connection->alfa()->prepare($sql);
            $e->execute();

            if($e->rowCount() > 0){
                    $res->data = false;
                    $res->messages = "La tabla ya existe";
            }else{
                $res->messages = "La tabla no existe";
                $res->data = true;
            }

            $res->success = true;

            $e->closeCursor();
            $e = null;
        }catch(PDOException$e){
            $res->errors = $e;
        }finally{
            return $res;
        }
    }

    public function executeThat($filename, $tableName){
        $res = new ServiceResult();
        $res->messages = [];
        try{
            $instructions = 0;
            $templine = '';
            // Read in entire file
            $lines = file($filename);
            // Loop through each line
            foreach ($lines as $line){
                // Skip it if it's a comment
                if (substr($line, 0, 2) == '--' || $line == '') 
                    continue;
                if(substr($line,0,2) == "/*")
                    continue;
                $line = preg_replace("((?<=TABLE )(.*)(?= \() | (?<=INTO )(.*)(?= \())", "`". $tableName ."`", $line);
                // Add this line to the current segment
                $templine .= preg_replace("(\n)", "", $line);
                // If it has a semicolon at the end, it's the end of the query
                if (substr(trim($line), -1, 1) == ';'){
                     // Perform the query
                     $e = $this->connection->alfa()->prepare($templine);
                     $e->execute();
                     array_push($res->messages,"Se alteraron ". $e->rowCount() ." filas.");
                     // Reset temp variable to empty
                     $templine = '';
                }
            }

            $res->success = true;
            $res->messages = App::makeItLegible($res->messages);
            $e->closeCursor();
            $e = null;
        }catch(PDOException$e){
            $res->errors = $e;
        }finally{
            return $res;
        }
    }

    public function createStudentsTable($campus){
        $res = new ServiceResult();
        try{   

            $db = "srjhi_p" . $campus;
            $ch = "utf8";
            $con = new Connection($db, $ch);

            $sql = "CREATE TABLE `students` (
                `nombre` varchar(50) CHARACTER SET utf8 NOT NULL,
                `nocta` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
                `fechanac` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
                `grupo` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
                `turno` int(1) NOT NULL,
                `grado` int(1) NOT NULL,
                `para` int(1) NOT NULL,
                `colegio` int(2) NOT NULL,
                `nomasig` int(4) NOT NULL,
                `prof` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
                `calle` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
                `cpost` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
                `colonia` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
                `delomun` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
                `ciudad` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
                `celular` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
                `telcasa` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
                `correo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
                `tutor` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
                `registration_date` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
                `photo_name` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
                `photo_path` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
                `estancia_corta` int(1) NOT NULL DEFAULT '0'
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";

            $e = $con->beta()->prepare($sql);
            $e->execute();
            $res->success = true;
        }catch(PDOException $e){
            $res->errors = $e;
        }finally{
            return $res;
        }
    }

    public function createProfesorsTable($campus){
        $res = new ServiceResult();
        try{   

            $db = "srjhi_p" . $campus;
            $ch = "utf8";
            $con = new Connection($db, $ch);

            $sql = "CREATE TABLE `prof` (
                `nombre` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
                `rfc` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
                `profesion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
                `nvl_estudios` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
                `turno` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
                `tel_oficina` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
                `tel_particular` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
                `celular` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
                `fecha_registro` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
                `fecha_ingreso` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
                `correo` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
                `calle` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
                `cp` int(5) NOT NULL,
                `colonia` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
                `alcaldia` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
                `ciudad` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
                `photo_name` varchar(25) COLLATE utf8_spanish2_ci DEFAULT NULL,
                `photo_path` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;";

            $e = $con->beta()->prepare($sql);
            $e->execute();
            $res->success = true;
        }catch(PDOException $e){
            $res->errors = $e;
        }finally{
            return $res;
        }
    }

    public function setRegisteredCampus($id){
        $res = new ServiceResult();
        try{
            $sql = "UPDATE info SET registrado = 1 WHERE clave = :id";
            $e = $this->connection->alfa()->prepare($sql);
            $e->bindParam(":id", $id);
            $e->execute();

            $res->success = true;

            $e->closeCursor();
            $e = null;
        }catch(PDOException$e){
            $res->errors = $e;
        }finally{
            return $res;
        }
    }
}