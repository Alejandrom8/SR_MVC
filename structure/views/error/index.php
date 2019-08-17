<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JHI - Error</title>
    <style>
        *{
            margin:0;
            padding:0;
        }
        .cont{
            width:100%;
            height:100%;
            min-height:100vh;
            background-color:#000;
            font-family:"Calibri", "Helvetica", "Sans-serif", "Arial";
            display:flex;
            align-items:center;
        }
        .margen h2{
            line-height:3rem;
        }
        .margen{
            width:60%;
            height:90%;
            text-align:center;
            color:#fff;
            padding:5%;
            margin:0 auto;
        }
        a{
            background-color:#fff;
            width:20%;
            height:10%;
            color:#222;
            border-radius:10px;
            border:1px solid #222;
            text-decoration:none;
            padding:1%;
            font-weight:bold;
        }
    </style>
</head>
<body>
    <div class="cont">
        <div class="margen">
            <h2>Error</h2>
            <a href="<?= constant("CONFIG")["url"] ?>">Inicio</a>
            <p style="padding:4%;"><?= $this->message ?><p>
            <img style="margin:4%;border-radius:5px;" src="<?= constant("CONFIG")["url"] ?>resources/images/gato_triste.png" width="200px" height="250px">
        </div>
    </div>
</body>
</html>