<html lang="es">
	<head>
		<?php include_once('structure/views/head.php'); ?>
		<title>Jóvenes Hacia la Investigación en ciencias experimentales</title>
    <link rel="stylesheet" type="text/css" href="<?= constant("CONFIG")["url"] ?>resources/stylesheet/indexStyles.css">    
	</head>
  <body>
	<div class="webpage" >
		<div class="container-own">
			<main class="shapes">
				<div id="particles-js" class="layer back"></div>
				<div class="layer front row">
					<!-- <div class="col-sm-12 onmovile-title">
							<h2>Jóvenes Hacia La Investigación <span class="subtitle-intern">en Ciencias Experimentales</span></h2>
							<hr>
					</div> -->
					<div class="col-md-6 banderin">
						<div class="cont">
							<div class="col-md-12 supertitle">
								<h2>Jóvenes Hacia La Investigación <span class="subtitle-intern">en Ciencias Experimentales</span></h2>
							</div>
							<div class="col-md-12 logos">
								<div class="ban"><img class="logo" src="<?= constant("CONFIG")["url"] ?>resources/images/escudounam_blanco.png"></div>
								<div class="ban "><img class="logo logo-jhi" src="<?= constant("CONFIG")["url"] ?>resources/images/jovenesblanco.png"></div>
								<div class="ban"><img class="logo" src="<?= constant("CONFIG")["url"] ?>resources/images/leopardos.png"></div>
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
								Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
								Egestas pretium aenean pharetra magna ac.
							</p>
							<br>
						</div>
						<div class="col-sm-12">
							<form action="<?= constant("CONFIG")['url'] ?>procedures/setSession/" method="POST" id="link-options">
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
									<button class="form-handler btn btn-primary btn-sm btn-block" name="typeForm" value="login">Inicia Sesión</button>
								</li>
								<li class="row" style="flex-wrap: nowrap;">
									<div class="col-sm-5"><hr></div>
									<div class="col-sm-2"><p>O</p></div>
									<div class="col-sm-5"><hr></div>
								</li>
								<li>
									<?= $this->registOption ?>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</main>
		</div>
	</div>
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
	particlesJS.load('particles-js', Generalconfig.url + 'resources/assets/particles.json', function() {
		console.log('callback - particles.js config loaded');
	});
	const welcome = new Welcome($(".form-handler"));
</script>
</html>
