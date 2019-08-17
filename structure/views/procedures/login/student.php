<div class="login-window cont-login-student">
    <div class="margen">
        <div class="title col-md-12">
            <div class="logo-cont">
                <!-- <img src="<?= constant("CONFIG")["url"] ?>resources/images/unamN.png"> -->
                <img src="<?= constant("CONFIG")["url"] ?>resources/images/jovenes.png">
                <!-- <img src="<?= constant("CONFIG")["url"] ?>resources/images/leopardos.png"> -->
            </div>
            <h2>Login - Alumnos</h2>
            <hr>
            <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p>
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