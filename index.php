<?php

  //configuracón de la aplicación
  require_once("config/config.php");
  //clases de control de datos
  require_once("mechanisms/dataFlow.php");
  //manejadores de la página web
  require_once("mechanisms/model.php");
  require_once("mechanisms/controller.php");
  require_once("mechanisms/view.php");
  //conexión con la base de datos
  require_once("mechanisms/connection.php");
  //clase que manejara el enrutamiento de la aplicacón
  require_once("mechanisms/app.php");
  //se crea el objeto controlador
  $jovenesHaciaLaInvestigacion = new App();
