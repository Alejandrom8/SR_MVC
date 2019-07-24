<html lang="es">
	<head>
		<?php include_once('structure/views/head.php'); ?>
		<title>Jóvenes Hacia la Investigación en ciencias experimentales</title>
    <link rel="stylesheet" type="text/css" href="<?= $config->url ?>resources/stylesheet/indexStyles.css">    
	</head>
  <body>
	<div id="seleccionar_plantel">
		<div class="window">	
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
	</div>
	<!-- CABECERA -->
	<div class="webpage">
	<div class="col-sm-12" style="margin:0;padding:0;">  
	  <div class="col-sm-6" style="padding:0;">
			<div class="left">
				<div id="particles-js"></div>
				<div class="contenido">
					<div class="jumbotron labelJum">
						<h1 style="font-family:Helvetica;">JÓVENES HACIA LA INVESTIGACIÓN <h2 style="font-size:3rem;">en Ciencias Experimentales</h2></h1>
					</div>
				</div>
			</div>
		</div>
	  <!-- fin de cabecera -->
		<div class="col-sm-6" id="rightForm" style="padding:0;">
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
					<div class="form">
						<!-- <a id="in">
							<label for="mostrar-modalIP">
								<span>
									<img src="imagenes/user-manualB.png" width="30px" height="30px">
								</span>
								Instrucciones de registro
							</label>
						</a> -->
						<form role="form" name="login2" action="<?= $config->url ?>login/loginProfesor" method="POST" class="FR" data-tipo = "prof">
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
					<div class="form">
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
						<form role="form" name="login" method="POST" action="<?= $config->url ?>login/loginAlumno" class="FR" id="form_alumno_login" data-tipo = "alumno">
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
	</div>
	<div id="designedBy" class="col-sm-12">
		<p>Sitio diseñado por Alejandro Gómez García</p>
	</div>
</body>
<script>
	const config = <?php echo file_get_contents("config/config.json"); ?>;
</script>
<script src="<?= $config->url ?>structure/controllers/js/welcome.js"></script>
<script src="<?= $config->url ?>resources/frameworks/particles.min.js"></script>
<script>
	particlesJS.load('particles-js', Generalconfig.url + 'resources/assets/particles.json', function() {
		console.log('callback - particles.js config loaded');
	});

	const proube = new Welcome(
		{
			window: "seleccionar_plantel",
			input: "plantel",
			button: "registrarPlantel"
		}
	);
</script>
</html>
