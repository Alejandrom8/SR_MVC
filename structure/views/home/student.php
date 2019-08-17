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
                <a class="button-href" href="#"><button>Comprobante</button></a>
                <a class="button-href" href="<?= constant("CONFIG")["url"] ?>goout"><button><i class="fas fa-sign-out-alt"></i> Salir</button></a>
            </section>
        </header>
        <section id="aperture">
            <h1>Jovenes Hacía la Investigación en Ciencias Experimentales</h1>
        </section>
        <section id="options" class="row">
            <div class="card col-md-4">
                <div class="card-body">
                    <h4 class="card-title">Descarga tu comprobante</h4>
                    <p class="card-text">Da click aquí para obtener tu comprobante en formato PDF.</p>
                    <br>
                    <a href="<?= constant("CONFIG")["url"] . "home/getProofOfRegistration/" . $_SESSION["campus"] . "/" . $this->user->accaunt ?>" class="btn btn-primary btn-block" target="_blanc">Descargar <i class="fas fa-file-download"></i></a>
                </div>
            </div>
            <div class="card col-md-4">
                <div class="card-body">
                    <h4 class="card-title">Actualiza tus datos</h4>
                    <p class="card-text">Si necesitas actualizar o corregir algún dato, da click aqui.</p>
                    <br>
                    <a href="#" class="btn btn-primary btn-block" onclick="showUpdateWindow();">Actualizar <i class="fas fa-pen-square"></i></a>
                </div>
            </div>
        </section>
        <section id="update-section">
            <button id="close-button" onclick="showUpdateWindow();">
                X
            </button>
            <div class="cont">
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
                        <div class="form-group">
                            <label for="name">Nombre: </label>
                            <input type="text" id="name" name="name" class="form-control" value="<?= $this->user->name ?>" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="accaunt">No. de cuenta: </label>
                            <input type="text" id="accaunt" name="accaunt" class="form-control" value="<?= $this->user->accaunt ?>" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="bornDate">Fecha de nacimiento: </label>
                            <input type="text" id="bornDate" name="bornDate" class="form-control" value="<?= $this->uei["bornDate"] ?>" readonly required>
                        </div>
                        <div class="form-group row">
                            <div class="col" style="padding:2%;">
                                <label for="grade">Grado: </label>
                                <input type="text" name="grade" id="grade" 
                                class="form-control" readonly
                                maxlength="2" pattern="([4-6])" value="<?= $this->uei["grade"] ?>"
                                readonly
                                >
                            </div>
                            <div class="col" style="padding:2%;">
                                <label for="group">Grupo: </label>
                                <input type="text" name="group" id="group"
                                class="form-control" readonly
                                maxlength="5" pattern="([0-9]|[A-Z])" value="<?= $this->uei["group"] ?>"
                                readonly
                                >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="turn">Turno:</label>
                            <select id="turn" name="turn" class="form-control" required>
                                <option value="<?= $this->uei["turn"] ?>"><?= constant("_DICT_")["turn"][$this->uei["turn"]] ?></option>
                                <option value="<?= (int) ! (boolean) (int) $this->uei["turn"] ?>"><?=  constant("_DICT_")["turn"][(int) ! (boolean) (int) $this->uei["turn"]]?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="reason">¿Es la primera vez que te inscribes al programa?</label><br>
                            <input type="radio" id="reason" name="reason" value="1" required>Si<br><!-- means inscription -->
                            <input type="radio" id="reason" name="reason" value="0" required>No<!-- means reinscription -->
                        </div>
                    </div>
                </div>
                <div class="col-md-12 second">
                    <h5>3. Tu dirección</h5>
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
                    <h5>4:  Otros datos</h5>
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
                    <h5>2. Acerca de tu área de interés</h5>
                    <br>
                    <div class="form-group">
                        <label for="college">Colegio: </label>
                        <select class="form-control" name="college" id="college" required>
                            <option value="">Seleccionar...</option>
                            <?php 
                                $colleges = $this->colleges;
                                foreach($colleges as $college){
                                $id = $college["id"];
                                $name = $college["name"];
                                echo '<option value="' . $id . '">' . $name . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject">Asignatura: </label>
                        <select class="form-control" name="subject" id="subject" required>
                            <option value="">Seleccionar...</option>
                        </select>
                        <p class="aclaration">(Selecciona antes el colegio)</p>
                    </div>
                    <div class="form-group">
                        <label for="profesor">Profesor: </label>
                        <select class="form-control" name="profesor" id="profesor" required>
                            <option value="">Seleccionar...</option>
                        </select>
                        <p class="aclaration">(Selecciona antes el colegio o la asignatura)</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
                    <br><br><br><br>
                </div>
            </div>
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

</script>
</body>
</html>