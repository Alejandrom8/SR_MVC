<h2 class="beeper-label" style="background-color:var(--green-cool);color:#fff;">Profesores</h2>
<div class="regist-container">
    <section id="regist-forms">
        <div class="swiper-container">
            <form class="swiper-wrapper" method="POST" id="regist" role="form" enctype="multipart/form-data">
              <!-- Primera ventana -->
              <div class="swiper-slide" id="window-1">
                <div class="col-sm-12" style="padding-left:10%;padding-right:10%;margin-bottom:5%;">
                  <h4>Registro al programa de Jovenes Hacia la Investigación <?= strftime("%Y") ?></h4>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6 instructions">
                      <div>
                        <p>
                          Revisa tus datos, confirma que tu grado y grupo sean correctos, de no ser así,
                          podrás modificar únicamente tu grado y grupo dando click en este botón:
                        </p>
                        <p>
                          Nota: esta modificación solo será usada en el contexto de este programa.
                        </p>
                        <br>
                        <center>
                        <img width="40%" height="40%" src="<?= constant("URL") ?>resources/images/unamN.png">
                        </center>
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
                        value="<?=$this->student->nocta?>" placeholder="profesión" required>
                      </div>
                      <div class="form-group">
                          <label for="education">Ingresa tu nivel de estudios: </label>
                          <input type="text" name="education" id="education" 
                          class="form-control" value="<?=$this->student->grade?>" required
                          placeholder="Nivel de estudios"
                          >
                      </div>
                      <div class="form-group">
                            <label for="turn">Turno</label>
                            <select name="turn" id="turn" class="form-control"  required>
                                <option value="">Seleccionar</option>
                                <option value="MATUTINO">Matutino</option>
                                <option value="VESPERTINO">Vespertino</option>
                                <option value="MIXTO">Mixto</option>
                            </select>
					  </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide" id="window-2">
                  <div class="col-md-12">
                  <div class="co-md-12">
                      <h4>Llena los datos que se solicitan a continuación</h4>
                      <br><br>
                  </div>
                  <div class="row" style="width:100%;">
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
                                          <img src="<?= constant("URL") ?>resources/images/defaultPhoto.png" width="60%" height="40%">
                                        </label>
                                    </center>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="<?= constant("quantities")['photoSize'] ?>" />
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
                          <label for="phoneOffice">Télefono de oficina: </label>
                          <input type="phone" name="phoneOffice" id="phoneOffice" class="form-control" required/>
                      </div>
                      <div class="form-group">
                          <label for="phone">Télefono particular: </label>
                          <input type="phone" name="phone" id="phone" maxlength="15" class="form-control" requrired/>
                      </div>
                      <div class="form-group">
                          <label for="mobil">Télefono celular: </label>
                          <input type="phone" name="mobil" id="mobil" maxlength="15" class="form-control" requrired/>
                      </div>
                      <div class="form-group">
                      <label for="email">Correo electrónico</label>
                          <input type="email" name="email" id="email" maxlength="50" class="form-control" required>
                      </div>
                      <div class="form-group">
                          <label for="startDate">Fecha en que ingreso al programa</label>
                          <input type="text" name="startDate" id="startDate" title="si no recuerda la fecha exacta, escriba solo el año" class="form-control" maxlength="25" required>
                          <p class="aclaration">(si no recuerda la fecha exacta, escriba solo el año)</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide" id="window-3">
                  <div class="col-lg-12">
                  <br>
                      <h4>Datos personales</h4>
                      <br><br>
                  </div>
                  <div class="col-lg-12" style="padding:0 4%;text-align:left;">
                        <h5>3. Tu dirección</h5>
                        <br/>
                        <div class="form-group">
                              <label for="street">Calle y Número: </label>
                              <input type="text" class="form-control" id="street" name="street" maxlength="60" required>
                          </div>
                          <div class="form-group">
                              <label for="colony">Colonia: </label>
                              <input type="text" class="form-control" id="colony" name="colony" maxlength="35" required>
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
                            <div class="col-sm-6 form-group">
                                <label for="city">Ciudad: </label>
                                <input type="text" class="form-control" id="city" name="city" maxlength="20" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="postalCode">Código Postal: </label>
                                <input type="text" class="form-control" id="postalCode" name="postalCode"
                                maxlength="5" required>
                            </div>
                          </div>
                  </div><!-- Ends 2nd col-md-12 row -->
                  <div class="col-md-12" style="display:flex;justify-content:space-around;padding:3%;">
                    <button type="submit" class="btn btn-secondary btn-block" id="registButton" style="background:var(--green-cool)">Registrar</button>
                  </div><!-- Ends 3rd col-md-12 -->
              </div><!-- Ends window 3 -->
            </form><!-- Ends swiper wrapper -->
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <button class="btn btn-primary swiper-button-next">siguiente</button>
            <button class="btn btn-primary swiper-button-prev">atrás</button>
        </div><!-- Ends swiper container -->
    </section>
</div><!-- Ends regist container -->
<!-- <script scr="<?= constant("URL") ?>resources/js/regist.js"></script> -->
<script>

    function simpleFilter(varToValidate){
      if(varToValidate != "" && varToValidate != null){
        return true;
      }
      return false;
    }

    $("#regist").on("submit", async function(e){
      e.preventDefault();
    //   $("#registButton").attr("disabled", "disabled");
      $("#registButton").val("Envando Datos...");
      let data = getFiles();
          data = getFormData("regist",data);
      const result = await makeRegist(data);
      manageRegistResponse(result);
    });

    async function makeRegist(data){
      try{
        $("#registButton").val("Registrando...");
        const response = await fetch(url + 'procedures/registProfesor', {
          method: 'POST',
          body: data
        });
        
        if(response.ok){
          return await response.json();
        }else{
          throw new Error("Error al procesar los datos enviados");
        }
      }catch(e){
        console.log(e);
      }
    }

    function manageRegistResponse(res){
      if(res != null){
          console.log(res);
        if(res.success){
          swal({
            "title": "!Registro Exitoso!",
            "text": "Te has registrado exitosamente, seras redireccionad@ a la página de inicio.",
            "icon": "success",
            "button": "ok"
          }).then( () => {
            window.location = res.onSuccessEvent;
          });
        }else{
          $("#registButton").removeAttr("disabled");
          $("#registButton").val("Registrar");
          console.log(res.errors);
          swal({
            "title": "Error de registro",
            "text": res.messages,
            "icon": "error",
            "button": "ok"
          });
        }
      }else{
        throw new Error("Hubo un error al intentar registrarte");
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

    const swiper = new Swiper('.swiper-container', {
      simulateTouch:false,
      pagination: {
        el: '.swiper-pagination',
        type: 'progressbar',
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });

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