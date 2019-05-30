<?php 

class Usuario{
    public $nombre;
    public $password;
    public $turno;
    public $celular;
    public $correo;
    public $foto;
}

class Profesor extends Usuario{
    public $rfc;
    public $profesion;
    public $nivelDeEstudios;
    public $fechaIngreso;
    public $materias;
    public $grupos;
    public $direccion;
}

class Alumno extends Usuario{
    public $nocta;
    public $fechanac;
    public $grupo;
    public $grado;
    public $direccion;
}

class Admin extends Usuario{
    public $permisos;
}

class ServiceResult {
    public $success;
    public $errors;
    public $messages;
    public $data;
    public $onSuccessEvent;
    public $onErrorEvent; 
} 

?>