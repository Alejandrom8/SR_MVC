<?php

class ProceduresModel extends Model{

    private $neutralTable;
    private $campusTable;

    public function __construct(){
        parent::__construct();

        $this->neutralTable = "p" . $_SESSION['campus'] . "_calif";
    }

    private function closeConnection($con){
        $con->closeCursor();
        return null;
    }

    /**
     * consultUser
     *
     * @param  mixed $id
     * @param  mixed $table
     * @param  mixed $comparator
     * @param  mixed $dataToObtain
     * @param  mixed $con
     *
     * @return void
     */
    private function consultUser($id, $table, $comparator, $dataToObtain, PDO $con){
        $response = ["success" => false, "data" => null];
        try{

            $sql = "SELECT $dataToObtain FROM $table WHERE $comparator = :id LIMIT 1";
            $e = $con->prepare($sql);
            $e->bindParam(":id", $id);
            $e->execute();

            if($e->rowCount() > 0){
                $d = $e->fetch(PDO::FETCH_ASSOC);
                $d = $d[$dataToObtain];
                $response["success"] = true;
                $response["data"] = $d;
            }

            $e = $this->closeConnection($e);

        }catch(PDOException $e){
            $response["data"] = $e;
        }finally{
            return $response;
        }
    }
    /**
    *   Method to consult the existence of a user depending on the
    *   coincidence of his account number and born date.
    * 
    *   @param { int } $id the student account number.
    *   @param { string } $pass the student born date.
    *   @return { ServiceResult } $res response object with the result:
    * 
    *      $res->success = True; if the user is found and his password is coinciding.
    *      $res->success = False && $res->errors = 1; if the user isn't found.
    *      $res->success = False && $res->errors = 2; si el usuario es encontrado pero no coincide su contraseña.
    *      $res->success = False && $res->errors = $e; si ha habido un error dentro del programa o con el servidor.
    */
    public function consultStudentIsSignedUp(int $id, string $pass){

        $res = new ServiceResult();

        try{
            $table = $this->neutralTable;
            $consultStudent = $this->consultUser(
                $id,
                $table,
                'nocta',
                'fecha',
                $this->connection->alfa()
            );

            if($consultStudent["success"] and $consultStudent["data"] != null){
                if($consultStudent["data"] === $pass){
                    $consultName = $this->consultUser(
                        $id,
                        $table,
                        'nocta',
                        'nombre',
                        $this->connection->alfa()
                    );
                    $res->success = true;
                    $res->data = $consultName["data"];
                }else{
                    $res->errors = 2;
                }
            }else{
                $res->errors = 1;
            }

        }catch(PDOException $e){
            $res->errors = $e;
        }finally{
            return $res;
        }
    }

    public function consultProfesorIsSignedUp(string $rfc, string $pass){
        $res = new ServiceResult();

        try{
            $tableName = "p" . $_SESSION['campus'] . "_horarios";

            $consultProfesor = $this->consultUser(
                $rfc,
                $tableName,
                'rfc',
                'rfc',
                $this->connection->alfa()
            );

            if($consultProfesor["success"] and $consultProfesor["data"] != null){
                if($consultProfesor["data"] === $pass){
                    $res->success = true;
                }else{
                    $res->errors = 2;
                }
            }else{
                $res->errors = 1;
            }

        }catch(PDOException $e){
            $res->errors = $e;
        }finally{
            return $res;
        }
    }

    public function consultRegist($id){
        $res = new ServiceResult();
        try{

            $consultStudentRegistered = $this->consultUser(
                $id,
                'students',
                'nocta',
                'nombre', 
                $this->connection->beta()
            );

            if($consultStudentRegistered["success"] and $consultStudentRegistered["data"] != null){
                $res->success = true;
                $res->data = $consultStudentRegistered["data"];
            }else{
                $res->errors = 1;
                $res->message = "Usuario no registrado"; 
            }

        }catch(PDOException $e){
            $res->errors = $e;
        }finally{
            return $res;
        }
    }

    public function getGroupAndDate($id){

        $res = new ServiceResult();

        try{

            $sql = "SELECT grupo,fecha FROM " . $this->neutralTable . " WHERE nocta = :id LIMIT 1";
            $e = $this->connection->alfa()->prepare($sql);
            $e->bindParam(":id", $id);
            $e->execute();

            $data = $e->fetch(PDO::FETCH_ASSOC);
            $group = $data["grupo"];
            $date = $data["fecha"];
            $result = ["group" => $group, "bornDate" => $date];

            $res->success = true;
            $res->data = $result;

            $e = $this->closeConnection($e);

        }catch(PDOException $error){
            $res->errors = $error;
        }finally{
            return $res;
        }
    }

    public function getColleges(){
        $res = new ServiceResult();
        try{
            $sql = "SELECT idcolegio,nombre FROM colegios ORDER BY nombre ASC";
            $e = $this->connection->alfa()->prepare($sql);
            $e->execute();
            
            $colleges = [];

            while($row = $e->fetch(PDO::FETCH_ASSOC)){
                $id = $row["idcolegio"];
                $name = $row["nombre"];
                $college = [ "id" => $id, "name" => $name];
                array_push($colleges, $college);
            }

            $res->data = $colleges;
            $res->success = true;

            $e = $this->closeConnection($e);

        }catch(PDOException $e){
            $res->errors = $e;
        }finally{
            return $res;
        }
    }

    public function getSubjects($college_id){
        $res = new ServiceResult();

        try{
            $sql = "SELECT clave,nombre FROM asig WHERE colegio = :id ORDER BY nombre ASC";
            $e = $this->connection->alfa()->prepare($sql);
            $e->bindParam(":id", $college_id);
            $e->execute();

            $subjects = [];

            while($row = $e->fetch(PDO::FETCH_ASSOC)){
                $id = $row["clave"];
                $name = $row["nombre"];
                $subject = ["id" => $id, "name" => $name];
                array_push($subjects, $subject);
            }

            $res->success = true;
            $res->data = $subjects;

            $e = $this->closeConnection($e);

        }catch(PDOException $error){
            $res->errors = $error;
        }finally{
            return $res;
        }
    }

    public function getProfesorsByCollege($college_id){
        $res = new ServiceResult();

        try{
            $sql = "SELECT DISTINCT rfc,nombre FROM auxiliar WHERE colegio = :id ORDER BY nombre ASC";
            $e = $this->connection->beta()->prepare($sql);
            $e->bindParam(":id", $college_id);
            $e->execute();

            $profesors = [];

            while($row = $e->fetch(PDO::FETCH_ASSOC)){
                $id = $row["rfc"];
                $name = utf8_decode($row["nombre"]);
                $profesor = ["rfc" => $id, "name" => $name];
                array_push($profesors, $profesor);
            }

            $res->success = true;
            $res->data = $profesors;

            $e = $this->closeConnection($e);

        }catch(PDOException $error){
            $res->errors = $error;
        }finally{
            return $res;
        }
    }

    public function getProfesorsBySubject($subject_id){
        $res = new ServiceResult();

        try{
            $sql = "SELECT DISTINCT rfc,nombre FROM auxiliar WHERE id_asignatura = :id ORDER BY nombre ASC";
            $e = $this->connection->beta()->prepare($sql);
            $e->bindParam(":id", $subject_id);
            $e->execute();

            $profesors = [];

            while($row = $e->fetch(PDO::FETCH_ASSOC)){
                $id = $row["rfc"];
                $name = utf8_decode($row["nombre"]);
                $profesor = ["rfc" => $id, "name" => $name];
                array_push($profesors, $profesor);
            }

            $res->success = true;
            $res->data = $profesors;

            $e = $this->closeConnection($e);

        }catch(PDOException $error){
            $res->errors = $error;
        }finally{
            return $res;
        }
    }

    public function searchExistingRegistry($id, $comparator, $table){
        $res = new ServiceResult();

        try{

            $sql = "SELECT * FROM $table WHERE $comparator = :id LIMIT 1";
            $e = $this->connection->beta()->prepare($sql);
            $e->bindParam(":id", $id);
            $e->execute();

            $res->data  = false;

            if($e->rowCount() > 0){
                $res->data = true;
            }

            $res->success = true;

            $e = $this->closeConnection($e);

        }catch(PDOException $e){
            $res->errors = $e;
        }finally{
            return $res;
        }
    }

    public function countStudentsRegistered($profesor){
        $res = new ServiceResult();
        try{
            $sql = "SELECT count(*) as total FROM students WHERE prof = :id";
            $e = $this->connection->beta()->prepare($sql);
            $e->bindParam(":id", $profesor);
            $e->execute();

            $data = $e->fetch(PDO::FETCH_ASSOC);
            $total = $data["total"];

            $res->data = $total;
            $res->success = true;

            $e = $this->closeConnection($e);
            
        }catch(PDOException $e){
            $res->errors = $e;
        }finally{
            return $res;
        }
    }

    public function registStudent($r){
        $res = new ServiceResult();
        try{

            $photoName = $r->photo["name"];
            $photoPath = $r->photo["path"];

            move_uploaded_file($r->photo["tmp"], $photoPath);

            $insert = "INSERT INTO students(nombre , nocta, fechanac, grupo, turno, grado, para, colegio, nomasig, prof, calle, cpost, colonia, delomun, ciudad, celular, telcasa, correo, tutor, registration_date, photo_name, photo_path, estancia_corta) 
                       VALUE(
                           '$r->name',
                           '$r->accaunt',
                           '$r->bornDate',
                           '$r->group',
                           '$r->turn',
                           '$r->grade',
                           '$r->reason',
                           '$r->college',
                           '$r->subject',
                           '$r->profesor',
                           '$r->street',
                           '$r->postalCode',
                           '$r->colony',
                           '$r->townHall',
                           '$r->city',
                           '$r->mobil',
                           '$r->phone',
                           '$r->email',
                           '$r->tutor',
                           '$r->registrationDate',
                           '$photoName',
                           '$photoPath',
                           0)";
            $e = $this->connection->beta()->prepare($insert);
            $e->execute();
            $e = $this->closeConnection($e);
            $res->success = true;

        }catch(PDOException $e){
            $res->errors = $e;
        }finally{
            return $res;
        }
    }
}