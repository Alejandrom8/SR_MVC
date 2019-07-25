<html lang="es">
	<head>
		<?php include_once('structure/views/head.php'); ?>
		<title>Jóvenes Hacia la Investigación en ciencias experimentales</title>
    <link rel="stylesheet" type="text/css" href="<?= constant("CONFIG")["url"] ?>resources/stylesheet/indexStyles.css">    
	</head>
  <body>
	<div class="webpage">
		<div class="container-own">
			<main class="shapes">
				<div id="particles-js" class="layer back"></div>
				<div class="layer front row">
					<div class="col-sm-12 onmovile-title">
							<h2>Jóvenes Hacia La Investigación <span class="subtitle-intern">en Ciencias Experimentales</span></h2>
							<hr>
					</div>
					<div class="col-md-2 banderin">
							<div class="ban ban-blue"><img class="logo" src="<?= constant("CONFIG")["url"] ?>resources/images/escudounam_blanco.png"></div>
							<div class="ban "><img class="logo logo-jhi" src="<?= constant("CONFIG")["url"] ?>resources/images/jovenesblanco.png"></div>
							<div class="ban"><img class="logo" src="<?= constant("CONFIG")["url"] ?>resources/images/leopardos.png"></div>
					</div>
					<div class="col-md-10 margen">
						<div class="col-sm-12 ondesktop-title">
							<h2>Jóvenes Hacia La Investigación <span class="subtitle-intern">en Ciencias Experimentales</span></h2>
							<hr>
						</div>
						<div class="col-sm-12">
							<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
								Egestas pretium aenean pharetra magna ac.
							</p>
						</div>
						<div class="col-sm-12">
							<form id="link-options">
								<div calss="form-group">
									<label for="campus">Plantel</label>
									<select class="form-control" name="campus" id="campus">
										<option value="">Seleccionar</option>
										<?= $this->registredCampus ?>
									</select>
								</div>
								<div calss="form-group">
									<label for="user">Usuario</label>
									<select class="form-control" name="user" id="user">
										<option value="">Seleccionar</option>
										<option value="student">Alumno</option>
										<option value="profesor">Profesor</option>
									</select>
								</div>
							</form>
							<ul class="button-group">
								<li>
									<button class="form-handler btn btn-primary btn-sm btn-block" name="login" value="login">Inicia Sesión</button>
								</li>
								<li class="row" style="flex-wrap: nowrap;">
									<div class="col-sm-5"><hr></div>
									<div class="col-sm-2"><p>O</p></div>
									<div class="col-sm-5"><hr></div>
								</li>
								<li>
									<button class="form-handler btn btn-primary btn-sm btn-block" name="regist" value="regist">Registrate</button>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</main>
		</div>
	</div>
	<!-- <div id="seleccionar_plantel"> -->
		<!-- <div class="window">	
	        <div class="margen">
	            <h3>Selecciona tu plantel</h3>
							<div class="form-group">
									<select name="plantel" id="plantel" class="form-control" required>
													<option value="">Selecciona tu plantel</option>
													<option value="1">No. 1 "Gabino Barreda"</option>
													<option value="2">No. 2 "Erasmo Castellanos Quinto"</option>
													<option value="3">No. 3 "Justo Sierra"</option>
													<option value="4">No. 4 "Vidal Castañeda y Nájera"</option>
													<option value="5">No. 5 "José Vasconcelos"</option>
													<option value="6">No. 6 "Antonio Caso"</option>
													<option value="7">No. 7 "Ezequiel A. Chávez"</option>
													<option value="8">No. 8 "Miguel E. Schulz"</option>
													<option value="9">No. 9 "Pedro de Alba"</option>
									</select>
							</div>
							<div class="form-group">
								<button id="registrarPlantel" class="btn btn-primary">Listo</button>
							</div>
	        </div>
	    </div>
	</div> -->
	<!-- CABECERA -->
	<!-- <div class="webpage">
	<div class="col-sm-12" style="margin:0;padding:0;">  
	  <div class="col-sm-12" style="padding:0;">
			<div class="left">
				<div id="particles-js"></div>
				<div class="contenido">
					<div class="jumbotron labelJum">
						<h1 style="font-family:Helvetica;">JÓVENES HACIA LA INVESTIGACIÓN <h2 style="font-size:3rem;">en Ciencias Experimentales</h2></h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div> -->
	  <!-- fin de cabecera -->
		<!-- <div class="col-sm-6" id="rightForm" style="padding:0;">
			<div class="jumbotron headJum" id="displayLogos">
					<img class="ljhi" src="<?= $config->url ?>resources/images/escudounam_blanco.png">
					<img class="ljhi" src="<?= $config->url ?>resources/images/jovenesblanco.png">
			</div>
			<div class="right">
				<div id="displayName"></div>
        <div id="menu" class="select">
					<label for="alumno" class="btn-group btn" id="a">
						<div>
							Alumno
							<input checked="checked" id="alumno" class="eleccion" name="alumno" type="radio" value="alumno"/>
						</div>
					</label>
          <label class="btn-group btn" id="o"> / </label>
					<label for="profesor" class="btn-group btn" id="p">
						<div>
							Profesor
							<input name="prof" id="profesor" class="eleccion" type="radio" value="profesor"/>
						</div>
					</label>
					<section id="debug"></section>
        </div>
				<div id="div2" style="display:none;" class="form-pa">
					<div class="form"> -->
						<!-- <a id="in">
							<label for="mostrar-modalIP">
								<span>
									<img src="imagenes/user-manualB.png" width="30px" height="30px">
								</span>
								Instrucciones de registro
							</label>
						</a> -->
						<!-- <form role="form" name="login2" action="<?= $config->url ?>login/loginProfesor" method="POST" class="FR" data-tipo = "prof">
							<div class="form-group">
								<label for="rfc">Usuario</label>
								<input type="text" class="form-control" id="rfc" name="rfc" placeholder="AAAA" maxlength="4" required>
							</div>
							<div class="form-group">
								<label for="pass">Contraseña</label>
								<input type="password" class="form-control" id="pass" name="pass" placeholder="112233" maxlength="6" required>
							</div>
							   <input type="hidden" name="estado" value="profesor">
								<br>
							<center><input type="submit" class="btn btn-primary" id="prof-button" value="Iniciar Sesión"></center>
						</form>
						<center><p> O </p></center>
						<center><button id="form_prof_regist" onclick='open_window_prof();' class="btn btn-success">Registrate</button></center>
						<br>
					</div>
				</div>
				<div id="div1" class="form-pa">
					<div class="form"> -->
						<!-- <ul class="instrucciones" style="list-style:none;">
							<li><h3><b>Alumno</b></h3></li>
						</ul><br> -->
							<!-- <a id="in">
								<label for="mostrar-modalI">
									<span>
										<img src="imagenes/user-manualB.png" width="30px" height="30px">
									</span>
									Instrucciones de registro
								</label>
							</a> -->
						<!-- <form role="form" name="login" method="POST" action="<?= $config->url ?>login/loginAlumno" class="FR" id="form_alumno_login" data-tipo = "alumno">
							<div class="form-group">
								<label for="nocta">Número de cuenta</label>
								<input type="text" class="form-control" id="nocta" name="nocta" placeholder="123456789" maxlength="9" required>
							</div>
							<div class="form-group">
								<label for="password">Fecha de Nacimiento</label>
								<input type="password" class="form-control" id="password" name="password" placeholder="ddmmaaaa" maxlength="8" required>
							</div>
							<input type="hidden" name="estado" value="alumno">
							<br>
							<center><input type="submit" class="btn btn-primary" id="alumno-button" value="Iniciar Sesión"></center>
							<div id="resp"></div>
						</form>
						<center><p> O </p></center>
						<center><button id="form_alumno_regist" onclick='open_window_alumno();' class="btn btn-success">Registrate</button></center>
						<br>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>-->
	<!-- <div id="designedBy" class="col-sm-12">
		<p>Sitio diseñado por Alejandro Gómez García</p>
	</div> -->
</body>
<!-- <script>
	const config = <?php echo file_get_contents("config/config.json"); ?>;
</script> -->
<script src="<?= constant("CONFIG")["url"] ?>structure/controllers/js/welcome.js"></script>
<script src="<?= constant("CONFIG")["url"] ?>resources/frameworks/particles.min.js"></script>
<script>
	particlesJS.load('particles-js', 'http://192.168.1.16/SR_MVC/resources/assets/particles.json', function() {
		console.log('callback - particles.js config loaded');
	});
	const welcome = new Welcome($(".form-handler"));
</script>
</html>
