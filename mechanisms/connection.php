<?php 

class Connection {

    private $user;
    private $password;
    private $host;
    private $dataBase;
    private $charset;

    public function __construct($db, $ch){
        $this->user = constant("USER");
        $this->password = constant("PASSWORD");
        $this->host = constant("HOST");
        $this->dataBase = $db;
        $this->charset = $ch;
    }

    public function alfa(){
        try{
            
            $conection = "mysql:host=" . $this->host . ";dbname=neutralConnection;charset=" . $this->charset;
            $options = [
              PDO::ATTR_ERRMODE             => PDO::ERRMODE_EXCEPTION,
              PDO::ATTR_EMULATE_PREPARES    => false,
              PDO::ATTR_ORACLE_NULLS      => PDO::NULL_TO_STRING,
            ];
            $pdo = new PDO($conection, $this->user, $this->password, $options);
    
        }catch(PDOException $e){

          print("<script>window.alert('Error de conexion alfa: " . $e->getMessage() . "');</script>");
          $pdo = new ManageError();
        
        }finally{
            return $pdo;
        }
    }

    public function beta(){
        try{
            
            $conection = "mysql:host=" . $this->host . ";dbname=" . $this->dataBase . ";charset=" . $this->charset;
            $options = [
              PDO::ATTR_ERRMODE             => PDO::ERRMODE_EXCEPTION,
              PDO::ATTR_EMULATE_PREPARES    => false,
              PDO::ATTR_ORACLE_NULLS      => PDO::NULL_TO_STRING,
            ];
            $pdo = new PDO($conection, $this->user, $this->password, $options);
    
        }catch(PDOException $e){

          print("<script>window.alert('Error de conexion beta: " . $e->getMessage() . "');</script>");
          $pdo = new ManageError();
        
        }finally{
            return $pdo;
        }
    }
}

?>