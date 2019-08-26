<html lang="en">
<head>
<title>Home</title>
    <?php include_once('structure/views/head.php'); ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= constant("CONFIG")["url"] ?>resources/stylesheet/home.css">
    <script src="<?= constant("CONFIG")["url"] ?>resources/frameworks/bootstrap/bootstrap.min.js"></script>
    <style>
        #concentrated.table{
            display:none;
        }
    </style>
</head>
<body>
<?php 

//siclo escolar
$s0 = strftime( "%Y" );
$s1 = $s0 + 1;

$table = "<table id='concentrated' class='table table-bordered table-striped' style='background-color:#fff;'>
            <thead>
                <caption align='top'>
                    <tr>
                        <td colspan='7' align='center'>
                            <h4><b>UNIVERSIDAD NACIONAL AUTONOMA DE MEXICO</h4></b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='7' align='center'>
                            <h4><b>ESCUELA NACIONAL PREPARATORIA</h4></b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='7' align='center'>
                            <h4><b>PROGRAMA \"JOVENES HACIA LA INVESTIGACION EN CIENCIAS EXPERIMENTALES\"</h4></b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='7' align='center'>
                            <h4><b>CICLO ESCOLAR " . $s0 . " - " . $s1 . "</h4></b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='7' align='center'>
                            <h4><b>CONCENTRADO DE LA RELACION DE SOLICITUDES DE REGISTRO DE ALUMNOS Y PROFESORES</h4></b>
                        </td>
                    </tr>
                </caption>
            </thead>
            <thead>
                <tr bgcolor='#eee'>
                    <th></th>
                    <th>Nombre del profesor promotor:</th>
                    <th>Fecha de ingreso</th>
                    <th>Materia(s) que imparte</th>
                    <th>Celular</th>
                    <th>Telefono de casa</th>
                    <th>Correo electronico</th>
                </tr>
                <tr>
                    <td></td>
                    <td>" . $this->profesor->name . "</td>
                    <td>" . $this->profesor->startDate . "</td>
                    <td><p>";

                // imprimiendo las materias del profesor 
                foreach($this->subjects as $sub){
                    $table .= $sub["name"]. "<br/>";
                }

            $table .= "</p></td>
                    <td>" . $this->profesor->mobil. "</td>
                    <td>" . $this->profesor->phone . "</td>
                    <td>" . $this->profesor->email . "</td>
                </tr>
            </thead>
            <thead>
                <tr bgcolor='#eee'>
                    <th>No.</th>
                    <th>Nombre del Alumno</th>
                    <th>No. de cuenta</th>
                    <th>grupo</th>
                    <th>Celular</th>
                    <th>Telefono</th>
                    <th>correo</th>
                </tr>
            </thead>";
            //tomando los datos de los alumnos e imprimiendolos en la tabla
            foreach($this->students as $i => $std){
                $i++;
                $table .= "
                    <tr>
                        <td>$i</td>
                        <td>". $std->name ."</td>
                        <td>". $std->accaunt ."</td>
                        <td>". $std->group ."</td>
                        <td>". $std->mobil ."</td>
                        <td>". $std->phone ."</td>
                        <td>". $std->email ."</td>
                    </tr>
                ";
            }
            $table .= "</table>";
    echo $table;
?>
    <div class="webpage">
        <header id="menu">
            <ul class="nav_logos">
                <li><img class="logo" src="<?= constant("CONFIG")["url"] ?>resources/images/escudounam_blanco.png" alt="UNAM"></li>
                <li><img class="logo" src="<?= constant("CONFIG")["url"] ?>resources/images/jovenesblanco.png" alt="UNAM"></li>
                <li><img class="logo" src="<?= constant("CONFIG")["url"] ?>resources/images/leopardos.png" alt="UNAM"></li>
            </ul>
            <span><?= $this->profesor->name ?></span>
            <img class="user-photo" src="<?= $this->profesor->photo ?>" alt="usuario">
            <button class="btn" onclick="show()">
                <i class="fa fa-bars fa-2x fa-sm"></i>
            </button>
            <section id="movibleSection">
                <a class="button-href" href="#"><button><i class="fas fa-home"></i> Inicio</button></a>
                <a class="button-href" href="<?= constant("CONFIG")["url"] ?>goout"><button><i class="fas fa-sign-out-alt"></i> Salir</button></a>
            </section>
        </header>
        <section id="aperture" class="profesor">
            <h1>Jóvenes Hacía la Investigación en Ciencias Experimentales</h1>
        </section>
        <section id="webapp">
            <aside>
                <table class="table">
                    <tr><th>Opciones</th></tr>
                    <tr class="tool_option" data-open="init"><td><i class="fas fa-home"></i>   Inicio</td></tr>
                    <tr class="tool_option" data-open="proof"><td><i class="fas fa-scroll"></i>   Comprobante de inscripción</td></tr>
                    <tr class="tool_option" data-open="update"><td><i class="fas fa-user-edit"></i>   Actualizar datos</td></tr>
                    <tr class="tool_option" data-open="management"><td><i class="fas fa-tasks"></i>   Administrar alumnos</td></tr>
                    <tr class="tool_option" data-open="docs"><td><i class="far fa-file"></i>   Documentos</td></tr>
                </table>
                <input type="button" id="setScreen" onclick="setScreen()" class="btn btn-secondary" value="Fijar pantalla">
            </aside>
            <section class="app" id="app">
                <div id="init" class="section-window" style="display:block;">
                    <h2 class="title-block">Acerca de</h2>
                </div>
                <div id="proof" class="section-window">
                    <h2 class="title-block">Comprobante</h2>
                    <embed src="<?= constant("CONFIG")["url"] ?>home/getProofOfRegistrationProfesor/<?= $_SESSION['campus']  . '/' . $_SESSION["user"] ?>" width="100%" height="100%">
                </div>
                <div id="update" class="section-window">
                    <h2 class="title-block">Actualización de datos</h2>
                    <form method="POST" id="updateInfo" role="form" enctype="multipart/form-data">
                        <div class="col-md-12 row">
                            <div class="col-md-6">
                                <div id="photo-cont" style="padding:4%;">
                                    <div class="card">
                                        <div class="card-header">
                                        <h5>1. Ingresa tu foto</h5>
                                        <span id="photoName"></span>
                                        </div>
                                        <div class="card-body">
                                            <div  class="foto-cont-2">
                                                <center>
                                                    <label id="preview" for="file">
                                                    <img src="<?= $this->profesor->photo ?>" width="60%" height="70%">
                                                    </label>
                                                </center>
                                                <input type="hidden" name="MAX_FILE_SIZE" value="<?= constant("CONFIG")["quantities"]['photoSize'] ?>" />
                                                <div class="input-group" style="margin-top:10%;">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="file" name="file" aria-describedby="inputGroupFileAddon01">
                                                        <label class="custom-file-label" for="file">Elige una foto</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                        <ul class="reglas">
                                            <li>Máximo 4MB de tamaño</li>
                                            <li><p>Únicamente formatos <span>.JPEG, .JPG o .PNG.</span></p></li>
                                        </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nombre completo: </label>
                                    <input type="text" name="name" id="name" class="form-control"
                                    value="<?=$this->profesor->name ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="rfc">RFC: </label>
                                    <input type="text" name="rfc" id="rfc" class="form-control"
                                    value="<?=$this->profesor->rfc ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="profession">Profesión: </label>
                                    <input type="text" name="profession" id="profession" class="form-control"
                                    value="<?=$this->profesor->profession?>" placeholder="profesión" required>
                                </div>
                                <div class="form-group">
                                    <label for="education">Ingresa tu nivel de estudios: </label>
                                    <input type="text" name="education" id="education" 
                                    class="form-control" value="<?=$this->profesor->education ?>" required
                                    placeholder="Nivel de estudios"
                                    >
                                </div>
                                <div class="form-group">
                                        <label for="turn">Turno</label>
                                        <select name="turn" id="turn" class="form-control"  required>
                                            <option value="<?= $this->profesor->turn ?>"><?= constant("_DICT_")["turn"][$this->profesor->turn] ?></option>
                                            <?php if($this->profesor->turn == 0){ ?>
                                                <option value="Vespertino">Vespertino</option>
                                                <option value="Mixto">Mixto</option>
                                            <?php }elseif($this->profesor->turn == 1){ ?>
                                                <option value="Matutino">Matutino</option>
                                                <option value="Mixto">Mixto</option>
                                            <?php }else{ ?>
                                                <option value="Matutino">Matutino</option>
                                                <option value="Vespertino">Vespertino</option>
                                            <?php } ?>
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                                    <br>
                                    <h4>Datos personales</h4>
                                    <br><br>
                                </div>
                        <div class="col-md-12">
                            <div class="row" style="width:100%;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phoneOffice">Télefono de oficina: </label>
                                        <input type="phone" name="phoneOffice" id="phoneOffice"
                                        class="form-control" value="<?= $this->profesor->phoneOffice ?>" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Télefono particular: </label>
                                        <input type="phone" name="phone" id="phone" maxlength="15" 
                                        class="form-control" value="<?= $this->profesor->phone ?>" requrired/>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobil">Télefono celular: </label>
                                        <input type="phone" name="mobil" id="mobil" maxlength="15" 
                                        class="form-control" value="<?= $this->profesor->mobil ?>" requrired/>
                                    </div>
                                    <div class="form-group">
                                    <label for="email">Correo electrónico</label>
                                        <input type="email" name="email" id="email" maxlength="50" 
                                        class="form-control" value="<?= $this->profesor->email ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="startDate">Fecha en que ingreso al programa</label>
                                        <input type="text" name="startDate" id="startDate" 
                                        title="si no recuerda la fecha exacta, escriba solo el año" class="form-control"
                                        maxlength="25" value="<?= $this->profesor->startDate ?>" required>
                                        <p class="aclaration">(si no recuerda la fecha exacta, escriba solo el año)</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="street">Calle y Número: </label>
                                            <input type="text" class="form-control" id="street" 
                                            name="street" maxlength="60" value="<?= $this->profesor->street ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="colony">Colonia: </label>
                                            <input type="text" class="form-control" id="colony" 
                                            name="colony" maxlength="35" value="<?= $this->profesor->colony ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="townHall">Alcaldia: </label>
                                            <select class="form-control" type="text" id="townHall" name="townHall" required>
                                                <option value="<?= $this->profesor->townHall ?>"><?= $this->profesor->townHall ?></option>
                                                <option value="">Seleccionar...</option>
                                                <option value="Álvaro Obregón">Álvaro Obregón</option>
                                                <option value="Azcapotzalco">Azcapotzalco</option>
                                                <option value="Benito Juárez">Benito Juárez</option>
                                                <option value="Coyoacán">Coyoacán</option>
                                                <option value="Cuajimalpa de Morelos">Cuajimalpa de Morelos</option>
                                                <option value="Cuauhtémoc">Cuauhtémoc</option>
                                                <option value="Gustavo A. Madero">Gustavo A. Madero</option>
                                                <option value="Iztacalco">Iztacalco</option>
                                                <option value="Iztapalapa">Iztapalapa</option>
                                                <option value="Magdalena Contreras">Magdalena Contreras</option>
                                                <option value="Miguel Hidalgo">Miguel Hidalgo</option>
                                                <option value="Milpa Alta">Milpa Alta</option>
                                                <option value="Tláhuac">Tláhuac</option>
                                                <option value="Tlalpan">Tlalpan</option>
                                                <option value="Venustiano Carranza">Venustiano Carranza</option>
                                                <option value="Xochimilco">Xochimilco</option>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 form-group">
                                                <label for="city">Ciudad: </label>
                                                <input type="text" class="form-control" id="city" name="city" 
                                                maxlength="20" value="<?= $this->profesor->city ?>" required>
                                            </div>
                                            <div class="col-sm-6 form-group">
                                                <label for="postalCode">Código Postal: </label>
                                                <input type="text" class="form-control" id="postalCode" name="postalCode"
                                                maxlength="5" value="<?= $this->profesor->postalCode ?>" required>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div><!--Ends col-md-12-->
                        <div class="col-md-12" style="display:flex;justify-content:space-around;padding:3%;">
                            <button type="submit" class="btn btn-secondary btn-block" id="updateButton" style="width:50%; background:var(--green-cool)">Actualizar datos</button>
                        </div><!-- Ends 3rd col-md-12 -->
                    </form><!-- Ends form -->
                </div><!-- Ends update -->
                <div id="management" class="section-window">
                    <h2 class="title-block">Alumnos inscritos <br/> <p style="font-size:1.4rem;">Total: <?= count($this->students) ?></p></h2>
                    <?php 
                        if(count($this->students) > 0){
                            $table = '<table class="table" id="students">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Foto</th>
                                                <th>Nombre</th>
                                                <th>No. de cuenta</th>
                                                <th>Grupo</th>
                                                <th>Celular</th>
                                                <th>Teléfono fijo</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                            foreach($this->students as $key => $std){
                                $key++;
                                $table .= "<tr>
                                            <td>$key</td>
                                            <td><img class='user-photo' src='$std->photo'></td>
                                            <td>$std->name</td>
                                            <td>$std->accaunt</td>
                                            <td>$std->group</td>
                                            <td>$std->mobil</td>
                                            <td>$std->phone</td>
                                            <td>$std->email</td>
                                          </tr>";
                            }

                            $table .= '</tbody></table>';

                            echo $table;
                        }else{
                            echo "No hay alumnos registrados por el momento";
                        }
                    ?>
                    <br><br><br>
                </div>
                <div id="docs" class="section-window">
                    <h2 class="title-block" style="padding-bottom:0;">Descarga de documentos</h2>
                    <div class="bloque col-md-12 row">
                        <div class="window col-md-5">
                            <h4>Comprobante de Inscripción</h4>
                            <p>Da click aquí para descargar tu comprobatne de inscripción</p>
                            <a class="btn btn-withe" href="<?= constant("CONFIG")["url"] ?>home/getProofOfRegistrationProfesor/<?= $_SESSION['campus']  . '/' . $_SESSION["user"] ?>" target="_blank"> <i class="fas fa-file-download"></i>  Descargar documento</a>
                        </div>
                        <div class="window col-md-5">
                            <h4>Concentrado de alumnos inscritos</h4>
                            <p>Da click aquí para descargar el concentrado de todos los alumnos que se han inscrito con tigo hasta la fecha en formato para Excel</p>
                            <button class="btn btn-withe" onclick="tableToExcel('concentrated', 'concentrado_alumnos.xls')"><i class="fas fa-file-download"></i>  Descargar documento</button>
                        </div>
                        <div class="window col-md-11 row">
                            <h4 class="col-md-12">Generar Credenciales</h4>
                            <div class="window col-md-5">
                                <h4>Un solo alumno</h4>
                                <p>Da click aquí para descargar el concentrado de todos los alumnos que se han inscrito con tigo hasta la fecha en formato para Excel</p>
                                <button class="btn btn-withe"> <i class="fas fa-file-download"></i>  Descargar documento</button>
                            </div>
                            <div class="window col-md-5">
                                <h4>Todos los alumnos</h4>
                                <p>Da click aquí para descargar el concentrado de todos los alumnos que se han inscrito con tigo hasta la fecha en formato para Excel</p>
                                <button class="btn btn-withe"> <i class="fas fa-file-download"></i>  Descargar documento</button>
                            </div>
                        </div>
                        <div class="window col-md-11 row">
                            <h4 class="col-md-12">Generar Constancias</h4>
                            <div class="window col-md-5">
                                <h4>Un solo alumno</h4>
                                <p>Da click aquí para descargar el concentrado de todos los alumnos que se han inscrito con tigo hasta la fecha en formato para Excel</p>
                                <button class="btn btn-withe"> <i class="fas fa-file-download"></i>  Descargar documento</button>
                            </div>
                            <div class="window col-md-5">
                                <h4>Todos los alumnos</h4>
                                <p>Da click aquí para descargar el concentrado de todos los alumnos que se han inscrito con tigo hasta la fecha en formato para Excel</p>
                                <button class="btn btn-withe"> <i class="fas fa-file-download"></i>  Descargar documento</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
        <?php include_once("structure/views/footer.php"); ?>
    </div>
<script src="<?= constant("CONFIG")["url"] ?>resources/frameworks/particles.min.js"></script>
<script type="text/javascript" src="<?= constant("CONFIG")["url"] ?>resources/js/excelExport.js"></script>
<script>
	particlesJS.load('aperture', Generalconfig.url + 'resources/assets/particles.json', function() {
		console.log('callback - particles.js config loaded');
	});

    let state = false, update = false;

    function show(){
        $(document).ready(function(){
            if(!state){
                $("#movibleSection").css({"right":"0"});
                // $(".container-own").css({"opacity": "0.9"});
                state = true;
            }else{
                $("#movibleSection").css({"right":"-100vw"});
                // $(".container-own").css({"opacity": "1"});
                state = false;
            }
        });
    }

    function showUpdateWindow(){
        if(!update){
            $("#update-section").css("display", "flex");
            update = true;
        }else{
            $("#update-section").css("display", "none");
            update = false;
        }
    }

    document.getElementById("file").onchange = function(e) {
      let reader = new FileReader();
      
      reader.onload = function(){
        let preview = document.getElementById('preview'),
            image = document.createElement('img');

        image.src = reader.result;
        
        preview.innerHTML = '';
        preview.append(image);
      };
    
      reader.readAsDataURL(e.target.files[0]);
      $("#photoName").html(e.target.files[0].name);
    }

    $("#updateInfo").on("submit", async function (e){
        e.preventDefault();
        $("#updateButton").attr("disabled", "disabled");
        $("#updateButton").val("Envando Datos...");
        let data = getFiles();
            data = getFormData("updateInfo",data);
        const result = await makeUpdate(data);
        console.log(result);
        manageUpdateResponse(result);
    });

    async function makeUpdate(data){
      try{
        $("#updateButton").val("Actualizando...");
        const response = await fetch(Generalconfig.url + 'procedures/updateProfesor', {
          method: 'POST',
          body: data
        });
        
        if(response.ok){
          return await response.json();
        }else{
          throw new Error("Error al procesar los datos enviados para actualizar");
        }
      }catch(e){
        console.log(e);
      }
    }

    function manageUpdateResponse(res){
      if(res != null){
        if(res.success){
          console.log(res.messages);
          swal({
            "title": "Actualización Exitosa!",
            "text": "Tus datos han sido actualizados de forma correcta.",
            "icon": "success",
            "button": "ok"
          }).then( () => {
            window.location = res.onSuccessEvent;
          });
        }else{
          $("#updateButton").removeAttr("disabled");
          $("#updateButton").val("Actualizar");
          console.log(res.errors);
          swal({
            "title": "Error de actualización",
            "text": res.messages,
            "icon": "error",
            "button": "ok"
          });
        }
      }else{
        throw new Error("Hubo un error al intentar Actualizar tus datos");
      }
    }

    function getFiles(){
      var idFiles=document.getElementById("file");
      // Obtenemos el listado de archivos en un array
      var archivos = idFiles.files;
      // Creamos un objeto FormData, que nos permitira enviar un formulario
      // Este objeto, ya tiene la propiedad multipart/form-data
      var data=new FormData();
      // Recorremos todo el array de archivos y lo vamos añadiendo all
      // objeto data
      // Al objeto data, le pasamos clave,valor
      data.append("photo",archivos[0]);
      return data;
    }
    
    function getFormData(id,data){
      $("#"+id).find("input,select").each(function(i,v) {
            if(v.type!=="file") {
                if(v.type==="checkbox" && v.checked===true) {
                    data.append(v.name,"on");
                }else{
                    data.append(v.name,v.value);
                }
            }
      });
      return data;
    }

    const windowActivator = document.querySelectorAll('.tool_option');
    windowActivator.forEach(win => {
        win.addEventListener("click", function(){
            const window = this.dataset.open;
            $(".section-window").css({'display':'none'});
            $(`#${window}`).css("display", "block");
        });
    });

    let screenFlag = false;

    function setScreen(){
        if(!screenFlag){
            $('html, body').animate({
                scrollTop: $(`#app`).offset().top - $("#menu").height()
            }, 1000);
            $("body").css("overflow", "hidden");
            $("#setScreen").val("Soltar pantalla");
            $("#webapp").css("height", "100vh");
            screenFlag = true;
        }else{
            $("body").css("overflow", "auto");
            $("#setScreen").val("Fijar pantalla");
            $("#webapp").css("height", "150vh");
            screenFlag = false;
        }
    }
</script>
</body>
</html>