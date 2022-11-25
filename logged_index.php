<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rǝvels</title>
        
        <link rel="icon" type="image/x-icon" href="images/_logo.png">
        
        <meta http-equiv="expires" content="Sat, 07 feb 2016 00:00:00 GMT">

        <script src="https://kit.fontawesome.com/92a45f44ad.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="styles\style.css">
    </head>
<body>
    <?= include('inc/cabecera_logged.inc.php')??'' ?>


    <!-- 
        Barra lateral con usuarios a los que sigue el logueado
    -->
    <nav id="slidebar-seguidos">
        <p>Seguidos</p>
        <hr>
        <ul>
            <li>Marcos</li>
            <li>Andrea</li>
            <li>Alberto</li>
            <li>Carmen</li>
            <li>Álex</li>
        </ul>
    </nav>

    <!-- 
        Muro de revels de seguidos
    -->
    <div id="muro-revels">

        <div class="revel-muro">
            <div class="usuario">
                <img src="images/user-1.png">
                <p>Adrián Benítez.<p>
            </div>
            <div class="contenido">
                afoPKJfoAKPEokcae opkcpo kpo kfcokc opak
            </div>
        </div>

    </div>

</body>
</html>