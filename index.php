<?php
    include('inc/Red-Objects.php');

    //$_SESSION = "";

    //Aseguramos que lleguen respuestas antes de validarlas
    $sesionIniciada = false;
    if(!empty($_SESSION)){
        $sesionIniciada = true;

        //print_r($_SESSION["red"]);
       
    }
    
?>
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


        <?php if(!$sesionIniciada) {?>
        <!-- BIENVENIDA Cuando no hay sesión iniciada -->
        <?php include('inc/cabecera.inc.php'); ?>
        <div class="mrg-50">
            <div class="centrado">
                <h1>Bienvenido a Rǝvels</h1>

                <div class="lista-bienvenida">
                    <img src="images/mockup.png" width="320px"> 
                    <div>
                        <p class="bienvenida-desc">Rǝvels es un sitio web de microblogging que permite a los usuarios publicar breves mensajes de texto, llamados "revels", de hasta 290 caracteres.</p>
                        <p class="bienvenida-desc">Los usuarios pueden enviar y recibir mensajes a través de la aplicación móvil o la web. Rǝvels también permite a los usuarios seguir a otros usuarios y marcar sus revels como "favoritos".</p>
                        <ul>
                            <li>Como Twitter pero sin bots.</li>
                            <li>Tu privacidad asegurada.</li>
                        </ul>
                        <p class="bienvenida-desc">Si ya tienes una cuenta de Revels <a href="login.php">inicia sesión</a>, si aún no <a href="registro.php">registrate</a>,</p>
                    </div>
                </div>
                <div class="index-btns">
                    <a href="login.php" class="btn-login">Login</a>
                    <a href="registro.php" class="btn-registro">Registro</a>
                </div>
                <div class="conectamos-personas">
                    <h2>Conectamos personas</h2>
                    <br>
                    <video autoplay muted loop width="930">
                        <source src="images/tierra.mp4" type="video/mp4">
                        Tu navegador no puede reproducir este video.
                    </video>
                </div>
                <br>
            </div>
        </div>
        
        <?php } if($sesionIniciada) ?>

        <h1>HOLA</h2>


        <?php include('inc/footer.inc.php'); ?>
    </body>
    
</html>