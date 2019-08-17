<!DOCTYPE html>
<html>
    <head>
        <?php include_once("structure/views/head.php"); ?>
        <title>JHI - ENP <?= $_SESSION['campus'] ?> - Registro para alumnos</title>
        <link rel="stylesheet" type="text/css" href="<?= constant("CONFIG")["url"] ?>node_modules/swiper/dist/css/swiper.min.css"> 
        <link rel="stylesheet" type="text/css" href="<?= constant("CONFIG")["url"] ?>resources/stylesheet/app.css"> 
        <script src="<?= constant("CONFIG")["url"] ?>node_modules/swiper/dist/js/swiper.min.js"></script>
        <script> const url = '<?= constant("CONFIG")["url"] ?>'; </script>
        <script src="<?= constant("CONFIG")["url"] ?>resources/js/login.js"></script>
    </head>
    <body>
        <div class="webpage">
            <?php //include_once("structure/views/menuRegist.php"); ?>
            <main class="container-own">
                <div class="window">
                    <?php include_once($this->form); ?>
                </div>
            </main>
            <footer>
            </footer>
        </div>
    </body>
</html>