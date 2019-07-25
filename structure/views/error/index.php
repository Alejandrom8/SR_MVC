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
            height:100vh;
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
            height:80%;
            text-align:center;
            color:#fff;
            padding:5%;
            margin:0 auto;
        }
    </style>
</head>
<body>
    <div class="cont">
        <div class="margen">
            <h2>Error</h2>
            <p><?= $this->message ?><p>
        </div>
    </div>
</body>
</html>