<?php 

class User{
    public $name;
    public $password;
    public $turn;
    public $phone;
    public $mobil;
    public $email;
    public $photo;
    public $registrationDate;
    //address
    public $colony;
    public $city;
    public $street;
    public $townHall;
    public $postalCode;

    public function setName($name){
        if(count(str_split($name)) <= 50){
            $this->name = $name;
            return true;
        }else{
            echo 'la longitud del nombre introducido es invalida';
            return false;
        }
    }

    public function setTurn($turn){
        $val = (int) $turn;
        /**
         * 0 = matutino
         * 1 = vespertino
         * 2 = mixto
         */
        if($val === 0 || $val === 1 || $val === 2){
            $this->turn = $val;
            return true;
        }else{
            echo 'Turno incorrecto';
            return false;
        }
    }

    public function getStringTurn(){

        $turn;

        if($this->turn == 0){
            $turn = "matutino";
        }else if($this->turn == 1){
            $turn = "vespertino";
        }else{
            $turn = "mixto";
        }

        return $turn;
    }

    public function setPhone($phone){
        // $phone = preg_replace('/([0-9])|(ext)/', '',$phone);
        $this->phone = $phone;
    }

    public function setStreet($street){
        $this->street = $street;
    }

    public function setColony($colony){
        $this->colony = $colony;
    }

    public function setTownHall($townHall){
        $this->townHall = $townHall;
    }

    public function setPostalCode($pd){
        $this->postalCode = $pd;
    }

    public function setCity($city){
        $this->city = $city;
    }

    public function setMobil($mobil){
        // $mobil = preg_replace('/([0-9])/', '',$mobil);
        $this->mobil = $mobil;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setRegistrationDate($date){
        $this->registrationDate = $date;
    }

    public static function generateId($accaunt){
        $final_id = $accaunt;
        $campus = $_SESSION['campus'];
        $final_digits = rand(0,9) . rand(0,9) .rand(0,9);
        $final_id .= "_" . $campus . "_" . $final_digits;

        return $final_id;
    }

    public function setPhoto($photo){

        $res = [
            "success" => false,
            "errors" => 0
        ];

        if($photo != null){

            $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png'];

            if(in_array($photo['type'], $allowedTypes)){
                if($photo['size'] <= (int) constant("CONFIG")['quantities']['photoSize']){

                    $type = explode('/', $photo['type']);
                    $type = $type[1];
                    $photoName = User::generateId($_SESSION['user']) . "." . $type;
                    $photoFinalPath = constant("PHOTO_FOLDER") . 'p' . $_SESSION['campus'] . '/' . $photoName;

                    $photoData = [
                        "name" => $photoName,
                        "path" => $photoFinalPath,
                        "tmp" => $photo["tmp_name"]
                    ];

                    $this->photo = $photoData;
                    $res["success"] = true;

                }else{
                    $userPhotoSize = round((int) $photo['size'] / 1048576, 2);//total megabytes 
                    $res["errors"] = "El tamaño de tu foto (" . $userPhotoSize . " mb) es muy grande ";
                }
            }else{
                $res["errors"] = "El formato de tu foto (" . $photo['type'] . ") es invalido.";
            }
        }else{
            $res["errors"] = "No se introdujo ninguna foto";
        }

        return $res;
    }
}

class Profesor extends User{
    public $rfc;
    public $profession;
    public $education;
    public $startDate;
    public $phoneOffice;
    public $materias;
    public $grupos;

    public function setRfc(string $rfc){
        $this->rfc = $rfc;
    }

    public function getRfc(){
        return $this->rfc;
    }

    public function setProfession($pro){
        $this->profession = $pro;
    }

    public function getProfession(){
        return $this->profession;
    }

    public function setEducation($edu){
        $this->education = $edu;
    }

    public function getEduction(){
        return $this->education;
    }

    public function setStartDate($date){
        $this->startDate = $date;
    }

    public function getStartDate(){
        return $this->startDate;
    }

    public function setPhoneOffice($phone){
        $this->phoneOffice = $phone;
    }

    public function getPhoneOffice(){
        return $this->phoneOffice;
    }
}

class Student extends User{
    public $accaunt;
    public $bornDate;
    public $group;
    public $grade;
    public $reason;
    public $tutor;
    public $college;
    public $subject;
    public $profesor;

    public function setAccaunt($accaunt){
        $this->accaunt = $accaunt;
    }

    public function setBornDate($date){
        $this->bornDate = $date;
    }

    public function setGroup($group){
        $this->group = $group;
    }

    public function setGrade($grade){
        $this->grade = $grade;
    }

    public function setReason($reason){
        $this->reason = (int) $reason;
    }

    public function setTutor($tutor){
        $this->tutor = $tutor;
    }

    public function setCollege($college){
        $this->college = $college;
    }

    public function setSubject($subject){
        $this->subject = $subject;
    }

    public function setProfesor($profesor){
        $this->profesor = $profesor;
    }
}

class Admin extends User{
    public $permisos;
}

class ServiceResult {
    public $success;
    public $errors;
    public $messages;
    public $data;
    public $onSuccessEvent;
    public $onErrorEvent;
    
    public function __construct(){
        $this->data = null;
        $this->success = false;
    }
} 

?>