<html lang="es">
	<head>
		<?php include_once('structure/views/head.php'); ?>
		<!-- Etiquetas de descripción -->
		<title>ENP - Jóvenes Hacia la Investigación en ciencias experimentales</title>
    <link rel="stylesheet" type="text/css" href="<?php echo constant("URL"); ?>resources/stylesheet/indexStyles.css">    
	</head>
  <body>
	<!-- CABECERA -->
	<div class="webpage">
	  <div class="col-md-6" style="padding:0;">
			<div class="left">
				<div id="particles-js"></div>
				<div class="contenido">
					<div class="jumbotron labelJum">
						<h1>JÓVENES HACIA LA INVESTIGACIÓN <h2 style="font-size:30px;">en Ciencias Experimentales</h2></h1>
					</div>
				</div>
			</div>
		</div>
	    <!-- fin de cabecera -->
		<div class="col-md-6" id="rightForm" style="padding:0;">
			<div class="jumbotron headJum" id="displayLogos">
					<img class="ljhi" src="<?php echo constant("URL"); ?>resources/images/escudounam_blanco.png">
					<img class="ljhi" src="<?php echo constant("URL"); ?>resources/images/jovenesblanco.png">
			</div>
			<div class="right">
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
						<form role="form" name="login2" action="PHP/login.php" method="POST" class="FR" data-tipo = "prof">
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
							<center><button type="submit" class="btn btn-primary" id="prof-button">Inicia Sesión</button></center>
						</form>
						<center><p> O </p></center>
						<center><button onclick='open_window_prof();' class="btn btn-success">Registrate</button></center>
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
						<form role="form" name="login" action="PHP/login.php" method="POST" class="FR" id="form_alumno_login" data-tipo = "alumno">
							<div class="form-group">
								<label for="username">Número de cuenta</label>
								<input type="text" class="form-control" id="username" name="username" placeholder="123456789" maxlength="9" required>
							</div>
							<div class="form-group">
								<label for="password">Fecha de Nacimiento</label>
								<input type="password" class="form-control" id="password" name="password" placeholder="ddmmaaaa" maxlength="8" required>
							</div>
							<input type="hidden" name="estado" value="alumno">
							<br>
							<center><button type="submit" class="btn btn-primary" id="alumno-button">Inicia Sesión</button></center>
							<div id="resp"></div>
						</form>
						<center><p> O </p></center>
						<center><button onclick='open_window_alumno();' class="btn btn-success">Registrate</button></center>
						<br>
					</div>
				</div>
			</div>
		</div>
		</div>
</body>
<script src="<?php echo constant("URL");?>structure/controllers/js/welcome.js"></script> -->
<script src="<?php echo constant("URL");?>resources/frameworks/particles.min.js"></script>
<script>
	particlesJS.load('particles-js', 'resources/assets/particles.json', function() {
		console.log('callback - particles.js config loaded');
	});
</script>
</html>
