<div class="login-window cont-login-student">
    <div class="margen">
        <div class="title col-md-12">
            <div class="logo-cont">
                <img src="<?= constant("CONFIG")["url"] ?>resources/images/unamN.png">
                <img src="<?= constant("CONFIG")["url"] ?>resources/images/jovenes.png">
                <!-- <img src="<?= constant("CONFIG")["url"] ?>resources/images/leopardos.png"> -->
            </div>
            <h2> Administración</h2>
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
                    <label for="user">Ingresa el nombre de usuario</label>
                    <input type="text" name="user" autocomplete="username" 
                    spellcheck="false" aria-label="user" id="user" 
                    class="form-control" placeholder="nombre de usuario" required>
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
        Generalconfig.url + "procedures/loginAdmon",
        document.getElementById("login-form"),
        $("#send"),
        $("#debugger")
    );
</script>