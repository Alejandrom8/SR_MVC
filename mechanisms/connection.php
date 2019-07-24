<?php 

class Connection {

    private $user;
    private $password;
    private $host;
    public $dataBase;
    public $charset;
    public $neutral;

    public function __construct($dataBase, $charset){
        $this->user = constant("USER");
        $this->password = constant("PASSWORD");
        $this->host = constant("HOST");
        $this->dataBase = $dataBase;
        $this->charset = $charset;
        $this->neutral = 'neutralConnection';
    }

    public function alfa(){
        try{
            
            $conection = "mysql:host=" . $this->host . ";dbname=" . $this->neutral . ";charset=" . $this->charset;
            $options = [
              PDO::ATTR_ERRMODE             => PDO::ERRMODE_EXCEPTION,
              PDO::ATTR_EMULATE_PREPARES    => false,
              PDO::ATTR_ORACLE_NULLS      => PDO::NULL_TO_STRING,
            ];
            $pdo = new PDO($conection, $this->user, $this->password, $options);
    
        }catch(PDOException $e){
          $pdo = new ManageError($e);
        }finally{
            return $pdo;
        }
    }

    public function beta(){
      if(isset($this->dataBase)){
        try{
            
            $conection = "mysql:host=" . $this->host . ";dbname=" . $this->dataBase . ";charset=" . $this->charset;
            $options = [
              PDO::ATTR_ERRMODE             => PDO::ERRMODE_EXCEPTION,
              PDO::ATTR_EMULATE_PREPARES    => false,
              PDO::ATTR_ORACLE_NULLS      => PDO::NULL_TO_STRING,
            ];
            $pdo = new PDO($conection, $this->user, $this->password, $options);
    
        }catch(PDOException $e){
          $pdo = new ManageError($e);
        }finally{
            return $pdo;
        }
      }
    }
}

?>