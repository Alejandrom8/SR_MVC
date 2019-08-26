<div class="login-window cont-login-student">
    <div class="margen">
        <div class="title col-md-12">
            <div class="logo-cont">
                <img src="<?= constant("CONFIG")["url"] ?>resources/images/unamN.png">
                <img src="<?= constant("CONFIG")["url"] ?>resources/images/jovenes.png">
                <!-- <img src="<?= constant("CONFIG")["url"] ?>resources/images/leopardos.png"> -->
            </div>
            <br>
            <h4>Iniciar sesión</h4>
            <h2>Profesor | <b>P<?= $_SESSION['campus'] ?></b></h2>
            <hr>
            <p>
                Los datos que necesitas para ingresar estan dentro de tu RFC (sin homoclave)
                los primeros 4 caracteres son tu usuario y el resto es tu contraseña. Ejemplo:
                <p style="line-height:0.8rem;">     RFC = AAAAaammdd</p>
                <p style="line-height:0.8rem;">     usuario = AAAA</p>
                <p style="line-height:0.8rem;">     contraseña = aammdd</p>
            </p>
            <br>
        </div>
        <div id="debugger" class="col-md-12"></div>
        <div class="col-md-12">
            <form class="form" method="POST" id="login-form">
                <div class="form-group">
                    <label for="rfc">Usuario</label>
                    <input type="text" name="rfc" autocomplete="username" 
                    spellcheck="false" aria-label="rfc" id="rfc" 
                    class="form-control" placeholder="Primeras letras del RFC" 
                    maxlength="4" required>
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
        url + "procedures/loginProfesors",
        document.getElementById("login-form"),
        $("#send"),
        $("#debugger")
    );
</script>