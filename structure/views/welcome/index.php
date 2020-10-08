<html lang="es">
	<head>
		<?php include_once('structure/views/head.php'); ?>
		<title>Jóvenes Hacia la Investigación en ciencias experimentales</title>
    <link rel="stylesheet" type="text/css" href="<?= constant("URL") ?>resources/stylesheet/indexStyles.css">    
	</head>
  <body>
	<div class="webpage" >
		<div class="container-own">
			<main class="shapes">
				<div id="particles-js" class="layer back"></div>
				<div class="layer front col-md-12 row">
					<div class="col-md-6 banderin">
						<div class="cont">
							<div class="col-md-12 supertitle">
								<h4><b>Programa de</b></h4>
								<h2>Jóvenes Hacia La Investigación <span class="subtitle-intern">en Ciencias Experimentales</span></h2>
							</div>
							<br>
							<div class="col-md-12 logos">
								<div class="ban"><img class="logo" src="<?= constant("URL") ?>resources/images/escudounam_blanco.png"></div>
								<div class="ban "><img class="logo logo-jhi" src="<?= constant("URL") ?>resources/images/jovenesblanco.png"></div>
								<div class="ban"><img class="logo" src="<?= constant("URL") ?>resources/images/leopardos.png"></div>
							</div>
						</div>
					</div>
					<div class="col-md-6 margen">
						<div class="col-sm-12 ondesktop-title" >
							<h2>Sistema de registro</h2>
							<hr>
						</div>
						<div class="col-sm-12" style="line-height:1.6rem;">
							<p>
								Bienvenid@ al programa de Jóvenes Hacia la investigación en ciencias experimentales.
								Para poder ingresar selecciona tu plantel de procedencia y posteriormente indica si
								eres un alumno o un profesor.
							</p>
							<br>
						</div>
						<div class="col-sm-12">
							<form action="<?= constant("URL") ?>procedures/setSession/" method="POST" id="link-options">
								<div calss="form-group">
									<label for="campus">Tu plantel</label>
									<select class="form-control" name="campus" id="campus">
										<?= $this->registredCampus ?>
									</select>
								</div>
								<br>
								<div calss="form-group">
									<label for="user">Tipo de usuario</label>
									<select class="form-control" name="user" id="user">
										<option value="">Seleccionar</option>
										<option value="student">Alumno</option>
										<option value="profesor">Profesor</option>
									</select>
								</div>
							</form>
							<ul class="button-group">
								<li>
									<button class="form-handler btn btn-primary btn-sm btn-block" name="typeForm" value="login">Inicia Sesión</button>
								</li>
								<li class="row" style="flex-wrap: nowrap;">
									<div class="col-sm-5"><hr></div>
									<div class="col-sm-2"><p>Ó</p></div>
									<div class="col-sm-5"><hr></div>
								</li>
								<li>
									<?= $this->registOption ?>
								</li>
							</ul>
						</div>
						<br>
						<p style="text-align:center;color:#888;">designed by <i>Alejandro Gómez García</i></p>
						<p style="text-align:center;color:#888;"><i>UNAM</i></p>
					</div>
					<br><br>
				</div>
			</main>
		</div>
	</div>
	<!-- <div id="designedBy" class="col-sm-12">
					<p>Designed by Alejandro Gómez García</p>
				</div> -->
</body>
<script src="<?= constant("URL") ?>structure/controllers/js/welcome.js"></script>
<script src="<?= constant("URL") ?>resources/frameworks/particles.min.js"></script>
<script>
	particlesJS.load('particles-js', Generalconfig.url + 'resources/assets/particles.json', function() {
		console.log('callback - particles.js config loaded');
	});
	const welcome = new Welcome($(".form-handler"));
</script>
</html>
