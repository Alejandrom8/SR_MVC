<header id="menu">
    <div class="margen">
        <section id="logo-section">
            <a class="navbar-brand" href="https://www.unam.mx/" target="_blank">
                <img src="<?= constant('CONFIG')['url'] ?>resources/images/escudounam_blanco.png" width="27px" height="27px">
            </a>
            <a class="navbar-brand" href="https://www.unam.mx/" target="_blank">
                <img src="<?= constant('CONFIG')['url'] ?>resources/images/jovenesblanco.png" width="27px" height="27px">
            </a>
            <a class="navbar-brand title" href="http://prepa8.unam.mx/p8/" target="_blank">
                <b>ENP <?= $_SESSION['campus'] ?></b>
            </a>   
        </section>
        <section id="link-section" class="row">
            <div class="col-md-9 name">
                <p><?= $_SESSION['username'] ?></p>
            </div>
            <div class="col-md-3 salir">
                <a href="<?= constant("CONFIG")["url"]?>goout" class="btn btn-danger">salir</a>
            </div>
        </section>
    </div>
</header>