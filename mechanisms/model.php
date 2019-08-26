<?php 

class Model{

    public $campus;

    public function __construct(){
        if(isset($_SESSION['campus'])){
            if($_SESSION["campus"] != "any"){
                $this->campus = (int) $_SESSION['campus'];
                $db = 'srjhi_p' . $this->campus;
                $ch = constant("CONFIG")["database"]["charset"]['prepa_' . $this->campus . '_charset'];
            }else{
                $this->campus = 8;
                $db = "srjhi_p8";
                $ch = constant("CONFIG")["database"]["charset"]['prepa_8_charset'];
            }
            $this->connection = new Connection($db, $ch);
        }
    }
}