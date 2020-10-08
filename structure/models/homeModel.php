<?php

class HomeModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function getPhoto($id, $typeUser){
        $res = new ServiceResult();
        try{
            $identifire = $typeUser == 'students' ? 'nocta' : 'rfc';
            $sql = "SELECT photo_name as photo FROM $typeUser WHERE $identifire = :id LIMIT 1";
            $e = $this->connection->beta()->prepare($sql);
            $e->bindParam(":id", $id);
            $e->execute();

            $data = $e->fetch(PDO::FETCH_ASSOC);
            $photo = $data["photo"];

            $e->closeCursor();
            $e = null;

            $res->data = $photo;
            $res->success = true;
            
        }catch(PDOException $e){
            $res->errors = $e;
        }finally{
            return $res;
        }
    }

    public function get_PDF_data($campus, $id){
        $res = new ServiceResult();
        try{
            $db = "srjhi_p" . $campus;
            $connection = new Connection($db, "utf8");
            
            $sql = "SELECT * FROM students WHERE nocta = :id LIMIT 1";
            $e = $connection->beta()->prepare($sql);
            $e->bindParam(":id", $id);
            $e->execute();

            $std = new Student();

            while($row = $e->fetch(PDO::FETCH_ASSOC)){

                $std->setName($row["nombre"]);
                $std->setAccaunt($row["nocta"]);
                $std->setBornDate($row["fechanac"]);
                $std->setGroup($row["grupo"]);
                $std->setTurn($row["turn"]);
                $std->setGrade($row["grado"]);
                $std->setReason($row["para"]);
                $std->setCollege($row["colegio"]);
                $std->setSubject($row["nomasig"]);
                $std->setProfesor($row["prof"]);
                $std->setStreet($row["calle"]);
                $std->setPostalCode($row["cpost"]);
                $std->setColony($row["colonia"]);
                $std->setTownHall($row["delomun"]);
                $std->setCity($row["ciudad"]);
                $std->setMobil($row["celular"]);
                $std->setPhone($row["telcasa"]);
                $std->setEmail($row["correo"]);
                $std->setTutor($row["tutor"]);
                $std->setRegistrationDate($row["registration_date"]);
                $std->photo = [
                    "name" => $row["photo_name"],
                    "path" => $row["photo_path"]
                ];

                break;
            }

            $res->data = $std;
            $res->success = true;

            $connection->closeCursor();
            $connection = null;

        }catch(PDOException $e){
            $res->errors = $e;
        }finally{ 
            return $res;
        }
    }

    public function get_PDF_Data_Prof($campus, $rfc){
        $res = new ServiceResult();
        try{
            $sql = "SELECT * FROM prof WHERE rfc = :rfc LIMIT 1";
            $con = new Connection('srjhi_p' . $campus, "utf8");
            $e = $con->beta()->prepare($sql);
            $e->bindParam(":rfc", $rfc);
            $e->execute();
            $data = $e->fetch(PDO::FETCH_ASSOC);
            
            $p = new Profesor();
            $p->setName($data["nombre"]);
            $p->setProfession($data["profesion"]);
            $p->setEducation($data["nvl_estudios"]);
            $p->setRfc($data["rfc"]);
            $p->setTurn($data["turno"]);
            $p->setMobil($data["celular"]);
            $p->setPhone($data["tel_particular"]);
            $p->setEmail($data["correo"]);
            $p->setPhoneOffice($data["tel_oficina"]);
            $p->setRegistrationDate($data["fecha_registro"]);
            $p->setStartDate($data["fecha_ingreso"]);
            $p->setStreet($data["calle"]);
            $p->setPostalCode($data["cp"]);
            $p->setColony($data["colonia"]);
            $p->setTownHall($data["alcaldia"]);
            $p->setCity($data["ciudad"]);

            if($data["photo_name"] != null){
                $p->photo = constant("photoPath") . "p" . $campus . "/" . $data["photo_name"];
            }else{
                $p->photo = constant("URL") . "resources/images/defaultPhoto.png";
            }

            $res->data = $p;
            $res->success = true;
            $e->closeCursor();
            $e = null;

        }catch(PDOEXception $e){
            $res->errors = $e;
        }finally{
            return $res;
        }
    }

    public function getProfSubjects($campus, $rfc){
        $res = new ServiceResult();
        try{
            $con = new Connection('srjhi_p' . $campus, "utf8");
            $sql = "SELECT DISTINCT
                        asig.clave, asig.nombre
                    FROM
                        asig,
                        p8_horarios
                    WHERE
                        p". $campus ."_horarios.rfc = :rfc
                        AND asig.clave = p8_horarios.asig";
            $e = $con->alfa()->prepare($sql);
            $e->bindParam(":rfc", $rfc);
            $e->execute();

            $subjects = [];
            
            while($row = $e->fetch(PDO::FETCH_ASSOC)){
                array_push($subjects, ["id" => $row["clave"], "name" => $row["nombre"]]);
            }

            $res->data = $subjects;
            $res->success = true;
            $e->closeCursor();
            $e = null;
        }catch(PDOException $e){
            $res->errors = $e;
        }finally{
            return $res;
        }
    }

    public function getAllInfo($id){
        $res = new ServiceResult();
        try{
            $sql = "SELECT * FROM students WHERE nocta = :id LIMIT 1";
            $e = $this->connection->beta()->prepare($sql);
            $e->bindParam(":id",$id);
            $e->execute();

            
            $data = $e->fetch(PDO::FETCH_ASSOC);

            $info = [
                "bornDate" => $data["fechanac"],
                "group" => $data["grupo"],
                "turn" => $data["turno"],
                "grade" => $data["grado"],
                "reason" => $data["para"],
                "college" => $data["colegio"],
                "subject" => $data["nomasig"],
                "profesor" => $data["prof"],
                "street" => $data["calle"],
                "postalCode" => $data["cpost"],
                "colony" => $data["colonia"],
                "townHall" => $data["delomun"],
                "city" => $data["ciudad"],
                "mobil" => $data["celular"],
                "phone" => $data["telcasa"],
                "email" => $data["correo"],
                "tutor" => $data["tutor"],
                "registration_date" => $date["registration_date"]
            ];

            $res->success = true;
            $res->data = $info;
            
        }catch(PDOException $e){
            $res->errors = $e;
        }finally{
            return $res;
        }
    }

    public function getStudents($campus, $prof){
        $res = new ServiceResult();
        try{
            $sql = "SELECT nombre, nocta, grupo, celular, telcasa, correo, photo_name
                    FROM students WHERE prof = :rfc
                    ORDER BY nombre ASC
            ";
            $e = $this->connection->beta()->prepare($sql);
            $e->bindParam(":rfc", $prof);
            $e->execute();
            
            $students = [];

            while($row = $e->fetch(PDO::FETCH_ASSOC)){
                $std = new Student();
                $std->setName($row["nombre"]);
                $std->setAccaunt($row["nocta"]);
                $std->setGroup($row["grupo"]);
                $std->setMobil($row["celular"]);
                $std->setPhone($row["telcasa"]);
                $std->setEmail($row["correo"]);
                if($row["photo_name"] != null){
                    $std->photo = constant("photoPath") . "p" . $campus . "/" .  $row["photo_name"];
                }else{
                    $std->photo = constant("URL") . "/resources/images/defaultPhoto.png";
                }
                array_push($students, $std);
            }

            $res->data = $students;
            $res->success = true;

            $e->closeCursor();
            $e = null;

        }catch(PDOException $e){
            $res->errors = $e;
        }finally{
            return $res;
        }
    }
}