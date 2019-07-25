<?php

class ProceduresModel extends Model{
    public function __construct(){
        parent::__construct();
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
    public function consultUser(int $id, string $pass){

        $res = new ServiceResult();

        try{

            $tableName = "p" . $_SESSION['campus'] . "_calif";

            $sql = "SELECT fecha FROM $tableName WHERE nocta = '$id' LIMIT 1";
            $e = $this->connection->alfa()->prepare($sql);
            // $e->bindParam(':id', $id);
            $e->execute();

            if($e->rowCount() > 0){
                $data = $e->fetch(PDO::FETCH_ASSOC);
                $fechanac = $data['fecha'];
                if($fechanac === $pass){
                    $res->success = true;
                }else{
                    $res->errors = 2;
                }
            }else{
                $res->errors = 1;
            }

            $e->closeCursor();

        }catch(PDOException $e){
            $res->errors = $e;
        }finally{
            return $res;
        }
    }

    public function consultRegist($id){
        $res = new ServiceResult();
        try{
            $sql = "SELECT no_cta,nombre FROM registro WHERE no_cta = :id";
            $e = $this->connection->beta()->prepare($sql);
            $e->bindParam(':id', $id);
            $e->execute();

            if($e->rowCount() > 0){
                $res->success = true;
                $data = $e->fetch(PDO::FETCH_ASSOC);
                $res->data = $data['nombre'];
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
}