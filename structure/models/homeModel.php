<?php

class HomeModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function getphotoPath($id){
        $res = new ServiceResult();
        try{
            $sql = "SELECT photo_name as photo FROM students WHERE nocta = :id LIMIT 1";
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
}