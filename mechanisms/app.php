<?php
/*
  Router.

  Clase para manejar el direccionamiento. 
  Cada que se introdusca una URL en el navegador, tendrá que seguir
  el siguiente formato:

      dominio/carpeta principal/clase/metodo/parametros
*/

require_once("structure/controllers/php/manageError.php");

class App{

  protected $user;  //usuario (integer)(alumno.length = 9; prof.length = 4)
  protected $campus; //plantel del usuario (integer)
  public $url;  //url actual del usuario, se manejara con el formato descrito anteriormente.

  public function __construct(){

    session_start();

    $this->user   = $_SESSION['user'];
    $this->campus = $_SESSION['campus'];
    $this->url    = isset($_GET['url']) ? $_GET['url'] : null;
    $permitedSections = ['goout', 'login', 'registro', 'welcome', 'procedures', 'admon'];
    
    $u = rtrim($this->url, '/');
    $u = explode('/', $u);
    $clase = $u[0];

    if(!empty($clase)){
      //si no esta vacia la url
      $access = in_array($clase, $permitedSections) ? true : $this->varValidate($this->user, $this->campus);
      if($access){
        $controller = 'structure/controllers/php/' . $clase . '.php';
        if(file_exists($controller)){

          require_once $controller;

          $page = new $clase;
          $page->loadModel($clase);
          
          $numberOfParameters = sizeof($u);
          
          if($numberOfParameters > 1){
            if(method_exists($page, $u[1])){
              if($numberOfParameters > 2){
                $parameters = [];
                for($i = 2; $i < $numberOfParameters; $i++){
                  array_push($parameters, $u[$i]);
                }
                $page->{$u[1]}($parameters);
              }else{
                $page->{$u[1]}();
              }
            }else{
              $page = new ManageError("Error 500: internal server error.");
            }
          }else{
            // $page->render();
          }
        }else{
          //la página no existe
          $page = new ManageError("La pagina a la que intenta entrar, no existe");
        }
      }else{
        //acceso denegado
        print("<script>
                  alert('acceso denegado');
                  window.location= '" . constant("CONFIG")["url"] . "';
              </script>");
      }
    }else{
      //si la url esta vacía se le redirecciona a la página principal
      require_once("structure/controllers/php/welcome.php");
      $welcomePage = new Welcome();
      $welcomePage->loadModel('welcome'); //se carga el modelo del correspondiente controlador
      $welcomePage->render();    //se crea una nueva vista 
      return false;
    }
  }

  /**
  *  función que resive un número de datos indefinidos de sesión 
  *  para validar la entrada del usuario a ciertas secciones.
  *  @access public.
  *  @param Array; Multiples variables de sesion.
  *  @return boolean; verdadero si las variables estan bien definidas.
  */
  public static function varValidate(){
    $variables_a_validar = func_get_args();
    foreach($variables_a_validar as $var){
      if(!isset($var) || $var == null || $var == "" || $var == " "){
        return false;
      }
    }
    return true;
  }

  public static function makeItLegible(array $errorMessages){
    $string = count($errorMessages) > 0 ? "Se presentaron las siguientes situaciónes (". count($errorMessages) ."): \n" : "No se presento ningun error";
    foreach($errorMessages as $key => $error){
        $string .= "Proceso " . $key + 1 . ": $error \n" . PHP_EOL;
    }
    return $string;
  }
}