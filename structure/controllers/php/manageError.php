<?php
class ManageError extends Controller{
    public function __construct(){
        parent::__construct();
        print("<script>alert('Error, la página a la que intentas entrar no existe o tiene acceso restringido');window.history.back();</script>");
    }
}
?>