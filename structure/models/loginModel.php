<?php 

class LoginModel extends Model{

    public function __construct(){
        parent::__construct();
        //$this->alfa = $this->connection->alfa();//conexion neutral
        //$this->beta = $this->connection->beta();//conexion dependiente del plantel
    }

    public function getSchoolName(int $id){
        $res = new ServiceResult();
        try{

            $sql = "SELECT nombre FROM info WHERE clave = :id";
            $e = $this->connection->alfa()->prepare($sql);
            $e->bindParam(":id", $id);
            $e->execute();

            $data = $e->fetch(PDO::FETCH_ASSOC);
            $res->data = $data["nombre"];
            $res->success = true;

            $e->closeCursor();

        }catch(PDOException $e){
            $res->errors = $e;
        }finally{
            return $res;
        }
    }

    public function consultUser(int $id, string $pass){

        /*
         *   Método para consultar la existencia de un usuario de acuerdo a la
         *   coincidencia de su número de cuenta y su fecha de nacimiento.
         * 
         *   @param { int $id } el numero de cuenta del alumno.
         *   @param { string $pass } la fecha de nacimiento del alumo.
         *   @return { ServiceResult $res } objeto respuesta con el resultado:
         * 
         *      $res->success = True; si el usuario es encontrado y además coincide su contraeña.
         *      $res->success = False && $res->errors = 1; si no es encontrado el usuario.
         *      $res->success = False && $res->errors = 2; si el usuario es encontrado pero no coincide su contraseña.
         *      $res->success = False && $res->errors = $e; si ha habido un error dentro del programa o con el servidor.
         */

        $res = new ServiceResult();

        try{

            $tableName = "p" . $_SESSION['school'] . "_calif";

            $sql = "SELECT fecha FROM $tableName WHERE nocta = :id LIMIT 1";
            $e = $this->connection->alfa()->prepare($sql);
            $e->bindParam(':id', $id);
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

?>