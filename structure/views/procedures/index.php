<!DOCTYPE html>
<html>
    <head>
        <?php include_once("structure/views/head.php"); ?>
        <title>Formularios</title>
        <link rel="stylesheet" type="text/css" href="<?= constant("CONFIG")["url"] ?>resources/stylesheet/procedures.css"> 
        <script>
            const url = '<?= constant("CONFIG")["url"] ?>';
        </script>
    </head>
    <body>
        <div class="webpage">
            <header id="head">
                    <img src="<?= constant('CONFIG')['url'] ?>resources/images/escudounam_blanco.png">
            </header>
            <main class="container-own">
                <div class="window">
                    <?php include_once($this->form); ?>
                </div>
            </main>
            <div id="return-button" onclick="window.location='<?= constant('CONFIG')['url'] ?>';" title="Página principal">
                <p><<</p>
            </div>
        </div>
    </body>
</html>