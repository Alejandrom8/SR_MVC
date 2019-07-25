<?php 

class Model{

    public $campus;

    public function __construct(){
        if(isset($_SESSION['campus'])){
            $this->campus = (int) $_SESSION['campus'];
            $db = 'srjhi_p' . $this->campus;
            $ch = constant("CONFIG")["database"]["charset"]['prepa_' . $this->campus . '_charset'];
            $this->connection = new Connection($db, $ch);
        }
    }
}

?>