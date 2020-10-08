<div class="regist-container">
    <section id="regist-forms">
        <div class="swiper-container">
            <form class="swiper-wrapper" method="POST" id="regist" role="form" enctype="multipart/form-data">
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
                        <button type="button" class="btn btn-info" id="letChange">
                          ¿Tu grado o grupo son incorrectos? 
                          <span>click aquí</span>
                        </button>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="name">Nombre: </label>
                        <input type="text" name="name" id="name" class="form-control"
                        value="<?=$this->student->name?>" readonly>
                      </div>
                      <div class="form-group">
                        <label for="bornDate">Fecha de nacimiento: </label>
                        <input type="text" name="bornDate" id="bornDate" class="form-control"
                        value="<?=$this->student->bornDate?>" readonly>
                      </div>
                      <div class="form-group">
                        <label for="accaunt">No. de cuenta: </label>
                        <input type="text" name="accaunt" id="accaunt" class="form-control"
                        value="<?=$this->student->nocta?>" readonly>
                      </div>
                      <div class="form-group row">
                        <div class="col">
                          <label for="grade">Grado: </label>
                          <input type="text" name="grade" id="grade" 
                          class="form-control" value="<?=$this->student->grade?>" readonly
                          maxlength="2" pattern="([4-6])"
                          >
                        </div>
                        <div class="col">
                          <label for="group">Grupo: </label>
                          <input type="text" name="group" id="group"
                          class="form-control" value="<?=$this->student->group?>" readonly
                          maxlength="5" pattern="((0-9])|[(A-Z))"
                          >
                        </div>
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
                                          <img src="<?= constant('CONFIG')['url']?>resources/images/defaultPhoto.png" width="60%" height="40%">
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
                          <label for="turn">Turno en el que estás actualmente: </label>
                          <select id="turn" name="turn" class="form-control">
                            <option value="">Seleccionar...</option>
                            <option value="0">Matutino</option>
                            <option value="1">Vespertino</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="reason">¿Es la primera vez que te inscribes al programa?</label><br>
                          <input type="radio" id="reason" name="reason" value="1" required>Si<br>
                          <input type="radio" id="reason" name="reason" value="0" required>No
                      </div>
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
                  </div>
                </div>
              </div>
              <div class="swiper-slide" id="window-3">
                  <div class="col-lg-12">
                  <br>
                      <h4>Datos personales</h4>
                      <br><br>
                  </div>
                  <div class="col-lg-12 row">
                    <div class="col-md-6">
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
                    </div><!-- Ends col-md-6  -->
                    <div class="col-md-6">
                        <h5>4. Otros datos</h5>
                        <br/>
                        <div class="form-group">
                              <label for="tutor">Nombre del Padre o Tutor: </label>
                              <input type="text" class="form-control" id="tutor" name="tutor"
                              maxlength="40" required>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="mobil">Tu teléfono Celular: </label>
                                <input type="text" class="form-control" id="mobil" name="mobil"
                                maxlength="10" placeholder="Ingresa tu teléfono celular" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="phone">Tu teléfono Fijo: </label>
                                <input type="text" class="form-control" id="phone" name="phone" 
                                maxlength="8" placeholder="Ingresa tu teléfono fijo" required>
                            </div>
                        </div>
                        <div class="form-group">
                                <label for="email">Correo Electrónico: </label>
                                <input type="email" class="form-control" id="email" name="email"
                                maxlength="40" placeholder="mail@example.com" required>
                        </div>
                    </div><!-- Ends col-md-6 -->
                  </div><!-- Ends 2nd col-md-12 row -->
                  <div class="col-md-12" style="display:flex;justify-content:space-around;padding:3%;">
                    <button type="submit" class="btn btn-warning btn-block" id="registButton" style="width:50%;">Registrar</button>
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
<!-- <script scr="<?= constant("CONFIG")["url"] ?>resources/js/regist.js"></script> -->
<script src="<?= constant("CONFIG")["url"] ?>resources/js/student.js"></script>