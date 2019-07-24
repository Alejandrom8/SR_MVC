<?php 

class Model{

    public $school;

    public function __construct(){
        if(isset($_SESSION['school'])){
            $this->school = $_SESSION['school'];
            $db = 'srjhi_p' . (int) $this->school;
            $ch = constant('prepa_' . (int) $this->school . '_charset');
            $this->connection = new Connection($db, $ch);
        }
    }
}

?>