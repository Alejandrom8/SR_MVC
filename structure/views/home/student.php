<html lang="en">
<head>
<title>Home</title>
    <?php include_once('structure/views/head.php'); ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= constant("CONFIG")["url"] ?>resources/stylesheet/home.css">
</head>
<body>
    <div class="webpage">
        <header id="menu">
            <ul class="nav_logos">
                <li><img class="logo" src="<?= constant("CONFIG")["url"] ?>resources/images/escudounam_blanco.png" alt="UNAM"></li>
                <li><img class="logo" src="<?= constant("CONFIG")["url"] ?>resources/images/jovenesblanco.png" alt="UNAM"></li>
                <li><img class="logo" src="<?= constant("CONFIG")["url"] ?>resources/images/leopardos.png" alt="UNAM"></li>
            </ul>
            <span><?= $this->user->name ?></span>
            <img class="user-photo" src="<?= $this->user->photo ?>" alt="usuario">
            <button class="btn" onclick="show()">
                <i class="fa fa-bars fa-2x fa-sm"></i>
            </button>
            <section id="movibleSection">
                <a class="button-href" href="#"><button><i class="fas fa-home"></i> Inicio</button></a>
                <a class="button-href" href="#" onclick="showUpdateWindow();"><button>Actualizar datos</button></a>
                <a class="button-href" href="<?= constant("CONFIG")["url"] . "home/getProofOfRegistration/" . $_SESSION["campus"] . "/" . $this->user->accaunt ?>" target="_blank"><button>Comprobante</button></a>
                <a class="button-href" href="<?= constant("CONFIG")["url"] ?>goout"><button><i class="fas fa-sign-out-alt"></i> Salir</button></a>
            </section>
        </header>
        <section id="aperture">
            <h1>Jóvenes Hacía la Investigación en Ciencias Experimentales</h1>
        </section>
        <section id="options" class="row">
        <div class="window">
                <h4 class="card-title">Descarga tu comprobante</h4>
                <p class="card-text">Da click aquí para obtener tu comprobante en formato PDF.</p>
                <br>
                <a href="<?= constant("CONFIG")["url"] . "home/getProofOfRegistration/" . $_SESSION["campus"] . "/" . $this->user->accaunt ?>" class="btn btn-primary btn-block" target="_blank">Descargar <i class="fas fa-file-download"></i></a>
            </div>
            <div class="window">
                    <h4 class="card-title">Actualiza tus datos</h4>
                    <p class="card-text">Si necesitas actualizar o corregir algún dato, da click aquí.</p>
                    <br>
                    <a href="#" class="btn btn-primary btn-block" onclick="showUpdateWindow();">Actualizar <i class="fas fa-pen-square"></i></a>
            </div>
        </section>
        <section id="update-section">
            <button id="close-button" onclick="showUpdateWindow();">
                X
            </button>
            <form class="cont" id="dataUpdate">
                <div class="col-md-12 title"><h4>Actualización de datos</h4></div>
                <div class="row">
                    <div class="col-md-6 photo">
                        <div class="card">
                        <div class="card-header">
                            <h5>Foto</h5>
                              <span id="photoName"></span>
                            </div>
                            <div class="card-body">
                                <div  class="foto-cont-2">
                                    <center>
                                        <label id="preview" for="file">
                                          <img src="<?= $this->user->photo ?>" width="60%" height="40%">
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
                    <div class="col-md-6 first">
                        <h5>1. Datos principales</h5>
                        <section style="background-color:#eee;padding:5%;margin:2% 1%;">
                            <div class="form-group">
                                <p>Nombre: <?= $this->user->name ?></p>
                            </div>
                            <div class="form-group">
                                <p>No. de cuenta: <?= $this->user->accaunt ?></p>
                            </div>
                            <div class="form-group">
                                <p>Fecha de nacimiento: <?= $this->uei["bornDate"] ?></p>
                            </div>
                            <div class="form-group">
                                    <p>Grado: <?= $this->uei["grade"] ?>°</p>
                            </div>
                            <div class="form-group">
                                <p>Grupo: <?= $this->uei["group"] ?></p>
                            </div>
                        </section>
                        <div class="form-group">
                            <label for="turn">Turno:</label>
                            <select id="turn" name="turn" class="form-control" required>
                                <option value="<?= $this->uei["turn"] ?>"><?= constant("_DICT_")["turn"][$this->uei["turn"]] ?></option>
                                <option value="<?= (int) ! (boolean) (int) $this->uei["turn"] ?>"><?=  constant("_DICT_")["turn"][(int) ! (boolean) (int) $this->uei["turn"]]?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="reason">¿Es la primera vez que te inscribes al programa?</label><br>
                            <?php if($this->uei["reason"]): ?>
                            <input type="radio" id="reason" name="reason" value="1" required checked>Si<br><!-- means inscription -->
                            <input type="radio" id="reason" name="reason" value="0" required>No<!-- means reinscription -->
                            <?php else:  ?>
                            <input type="radio" id="reason" name="reason" value="1" required>Si<br><!-- means inscription -->
                            <input type="radio" id="reason" name="reason" value="0" required checked>No<!-- means reinscription -->
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 second">
                    <h5>2. Tu dirección</h5>
                    <br/>
                    <div class="form-group">
                        <label for="street">Calle y Número: </label>
                        <input type="text" class="form-control" id="street" 
                        name="street" maxlength="60" required value="<?= $this->uei["street"] ?>"
                        >
                    </div>
                    <div class="form-group">
                        <label for="colony">Colonia: </label>
                        <input type="text" class="form-control" id="colony" 
                        name="colony" maxlength="35" required value="<?= $this->uei["colony"] ?>"
                        >
                    </div>
                    <div class="form-group">
                        <label for="townHall">Alcaldia: </label>
                        <select class="form-control" type="text" id="townHall" name="townHall" required>
                            <?= "<option value='" . $this->uei["townHall"] . "'>" . $this->uei["townHall"] . "</option>" ?>
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
                        <div class="col" style="padding:2%;">
                            <label for="city">Ciudad: </label>
                            <input type="text" class="form-control" id="city" 
                            name="city" maxlength="20" required value="<?= $this->uei["city"] ?>"
                            >
                        </div>
                        <div class="col" style="padding:2%;">
                            <label for="postalCode">Código Postal: </label>
                            <input type="text" class="form-control" id="postalCode" 
                            name="postalCode" maxlength="5" required value="<?= $this->uei["postalCode"] ?>"
                            >
                        </div>
                    </div>
                </div>
                <div class="col-md-12 third">
                    <h5>3:  Otros datos</h5>
                    <br/>
                    <div class="form-group">
                            <label for="tutor">Nombre del Padre o Tutor: </label>
                            <input type="text" class="form-control" id="tutor" 
                            name="tutor" maxlength="40" required value="<?= $this->uei["tutor"] ?>"
                            >
                    </div>
                    <div class="form-group row">
                        <div class="col" style="padding:2%;">
                            <label for="mobil">Teléfono Celular: </label>
                            <input type="text" class="form-control" id="mobil" name="mobil"
                            maxlength="10" placeholder="Ingresa tu teléfono celular" required
                            value="<?= $this->uei["mobil"] ?>"
                            >
                        </div>
                        <div class="col" style="padding:2%;">
                            <label for="phone">Teléfono Fijo: </label>
                            <input type="text" class="form-control" id="phone" name="phone" 
                            maxlength="8" placeholder="Ingresa tu teléfono fijo" required
                            value="<?= $this->uei["phone"] ?>"
                            >
                        </div>
                    </div>
                    <div class="form-group">
                            <label for="email">Correo Electrónico: </label>
                            <input type="email" class="form-control" id="email" name="email"
                            maxlength="40" placeholder="mail@example.com" required
                            value="<?= $this->uei["email"] ?>"
                            >
                    </div>
                </div>
                <div class="col-md-12 fourth">
                    <h5>4. Acerca de tu área de interés</h5>
                    <br>
                    <div class="form-group">
                        <label for="college">Colegio: </label>
                        <select class="form-control" name="college" id="college" required>
                            <?= "<option value='". $this->uei["college"] ."'>". $this->uei["collegeName"] ."</option>" ?>
                            <option value="">Seleccionar...</option>
                            <?php 
                                foreach($this->colleges as $col){
                                    echo "<option value='". $col["id"] ."'>". $col["name"] ."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject">Asignatura: </label>
                        <select class="form-control" name="subject" id="subject" required>
                            <option value="<?= $this->uei["subject"] ?>"><?= $this->uei["subjectName"] ?></option>
                            <option value="">Seleccionar...</option>
                            <?php 
                                foreach($this->subjects as $sub){
                                    echo "<option value='". $sub["id"] ."'>". $sub["name"] ."</option>";
                                }
                            ?>
                        </select>
                        <p class="aclaration">(Selecciona antes el colegio)</p>
                    </div>
                    <div class="form-group">
                        <label for="profesor">Profesor: </label>
                        <select class="form-control" name="profesor" id="profesor" required>
                            <?= "<option value='". $this->uei["profesor"] ."'>". $this->uei["profesorName"] ."</option>" ?>
                            <option value="">Seleccionar...</option>
                            <?php 
                                foreach($this->profesors as $prof){
                                    echo "<option value='". $prof["rfc"] ."'>". $prof["name"] ."</option>";
                                }
                            ?>
                        </select>
                        <p class="aclaration">(Selecciona antes el colegio o la asignatura)</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <button id="updateButton" type="submit" class="btn btn-primary btn-block">Actualizar</button>
                    <br><br><br><br>
                </div>
            </form>
        </section>
        <?php include_once("structure/views/footer.php"); ?>
    </div>
<script src="<?= constant("CONFIG")["url"] ?>resources/frameworks/particles.min.js"></script>
<script>
	particlesJS.load('aperture', Generalconfig.url + 'resources/assets/particlesV2.json', function() {
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

    async function getData(type,college_id){
      try{
        const response = await fetch(Generalconfig.url + "procedures/get" + type + "/" + college_id);
        if(response.ok){
          return await response.json(); 
        }else{
          throw new Error("Error al cargar datos de este colegio");
        }
      }catch(e){
        console.log(e);
      }

      return null;
    }

    function putSubjects(subjects){
      if(subjects.success){
        $("#subject").empty();
        subjects.data.forEach( subject => {
          $("#subject").append(`
            <option value="${subject.id}">${subject.name}</option>
          `);
        });
      }else{
        swal({
          "title": "Error de carga de datos",
          "text": "Ocurrio un error al cargar las asignaturas: " + subjects.errors,
          "icon": "error",
          "button": ["Oh noo!"]
        });
      }
    }

    function putProfesors(profesors){
      if(profesors.success){
        $("#profesor").empty();
        profesors.data.forEach( profesor => {
          $("#profesor").append(`
            <option value="${profesor.rfc}">${profesor.name}</option>
          `);
        });
      }else{
        swal({
          "title": "Error de carga de datos",
          "text": "Ocurrio un error al cargar los profesores: " + profesors.errors,
          "icon": "error",
          "button": ["Oh noo!"]
        });
      }
    }

    $("#college").on("change", async function (){
      const college_id = $(this).val();
      const subjects = await getData("Subjects",college_id);
      putSubjects(subjects);
      const profesors = await getData("Profesors",college_id);
      putProfesors(profesors);
    });

    $("#subject").on("change", async function(){
      const college_id = $("#college").val();
      if(college_id != ""){
        const subject_id = $(this).val();
        const profesors = await getData("Profesors", college_id + "/" + subject_id);
        putProfesors(profesors);
      }else{
        swal({
          "title": "Primero debes seleccionar un colegio",
          "icon": "warning",
          "button": "ok"
        });
      }
    });

    $("#dataUpdate").on("submit", async function (e){
        e.preventDefault();
        $("#updateButton").attr("disabled", "disabled");
        $("#updateButton").val("Envando Datos...");
        let data = getFiles();
            data = getFormData("dataUpdate",data);
        const result = await makeUpdate(data);
        console.log(result);
        manageUpdateResponse(result);
    });

    async function makeUpdate(data){
      try{
        $("#updateButton").val("Actualizando...");
        const response = await fetch(Generalconfig.url + 'procedures/updateStudent', {
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

</script>
</body>
</html>