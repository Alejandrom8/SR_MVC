<div class="login-window cont-login-student">
    <div class="margen">
        <div class="title col-md-12">
            <div class="logo-cont">
                <img src="<?= constant("URL") ?>resources/images/unamN.png">
                <img src="<?= constant("URL") ?>resources/images/jovenes.png">
                <!-- <img src="<?= constant("URL") ?>resources/images/leopardos.png"> -->
            </div>
            <br>
            <h4>Iniciar sesión</h4>
            <h2> Alumnos | <b>P<?= $_SESSION['campus'] ?></b></h2>
            <hr>
            <p>
                Los datos para ingresar son tu número de cuenta como usuario y tu fecha de nacimiento como contraseña
                en formato ddmmaaaa.
            </p>
            <br>
        </div>
        <div id="debugger" class="col-md-12"></div>
        <div class="col-md-12">
            <form class="form" method="POST" id="login-form">
                <div class="form-group">
                    <label for="account">Ingresa tu número de cuenta</label>
                    <input type="text" name="account" autocomplete="username" 
                    spellcheck="false" aria-label="account" id="account" 
                    class="form-control" placeholder="numero de cuenta" required>
                </div>
                <div class="form-group">
                    <label for="pass">Contraseña</label>
                    <input type="password" name="pass" id="pass" autocomplete="password"
                    spellcheck="false" class="form-control" placeholder="Contraseña" required>
                </div>
                <br>
                <center><input type="submit" name="send" id="send" class="btn btn-primary btn-block" value="Entrar"></center>
            </form>
        </div>
    </div>
</div>
<script>
    const loginForm = new LoginForm(
        url + "procedures/loginStudent",
        document.getElementById("login-form"),
        $("#send"),
        $("#debugger")
    );
</script>