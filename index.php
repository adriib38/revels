<?php

    include('inc/sesion_pruebas.inc.php');  //BORRAR
    include('inc\red\bd.inc.php');
    
    /**
     * Comprobamos si hay sesión iniciada para mostrar "Bienvenida" o "Muro".
     * 
     */
    $idUser = $id_session_simulator;
    if($idUser != 0) {
        $sesionIniciada = true;
        $userIniciado = selectUserById($idUser);
    }

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rǝvels</title>
        
        <meta name="description" content="Rǝvels es un sitio web de microblogging que permite a los usuarios publicar breves mensajes de texto, llamados 'revels', de hasta 290 caracteres.">
        <meta name="keywords" content="revels, revel"/>
        <meta name="author" content="Adrián Benítez" />
        <meta name="robots" content="index"/>

        <meta property="og:title" content="Revels" />
        <meta property="og:url" content="http://www.revels.com/" />
        <meta property="og:image" content="images/revels-banner.png" />
        <meta property="og:description" content="Rǝvels es un sitio web de microblogging que permite a los usuarios publicar breves mensajes de texto, llamados 'revels', de hasta 290 caracteres." />

        <link rel="icon" type="image/x-icon" href="images/_logo.png">
        <script src="https://kit.fontawesome.com/92a45f44ad.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="styles\style.css">
    </head>
    <body>
        
        <?php if(!$sesionIniciada) { ?>
            <!--
                BIENVENIDA Cuando no hay sesión iniciada
            -->
            <?php
                include('inc/cabecera.inc.php'); 
                include('inc/red/bd.inc.php');  
            ?>
            
            <div class="mrg-50">
                <div class="centrado">
                    <h1>Bienvenido a <span class="titulo-incicio">Rǝvels</span></h1>

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
                    <h2>Empieza a compartir momentos</h2>
                <div class="index-btns">
                    <a href="login.php" class="btn-login">Login</a>
                    <a href="registro.php" class="btn-registro">Registro</a>
                </div>
                <img src="images/collage-momentos.png" width=1200px>
                <div class="conectamos-personas">
                    <h2>Conectamos personas</h2>
                    <br>
                    <video autoplay muted loop width="930">
                        <source src="images/tierra.mp4" type="video/mp4">
                        Tu navegador no puede reproducir este video.
                    </video>
                </div>
                </div>
            </div>
        <?php } if($sesionIniciada){ ?>
            <!-- 
                Navbar sesión inciada
            -->
            <?php include('inc/cabecera_logged.inc.php'); ?>
            
            <!--
                Slidebar usuarios seguidos
            -->
            <?php 
                $seguidos = selectFollowsFromUser($idUser); 
            ?>         
            <nav id="slidebar-seguidos">
                <p>Seguidos</p>
                <hr>
                <ul>
                    <?php
                        if(count($seguidos) == 0) { echo "<li>Aún no sigues a nadie</li>"; }
                        foreach($seguidos as $seguido){
                            echo  '<li>'.$seguido->usuario.'</li>';
                        }
                    ?>
                </ul>
            </nav>

            <!-- 
                Muro de revels de seguidos

                AHORA ES DE TUS REVELS
            -->
            <div class="muro">
            <h2>Últimos Rǝvels</h2>
            <div class="underline"></div>
            <?php
            $revels = selectRevelsFromUser($idUser); 
                foreach($revels as $revel){
                    $userId = $revel->id;
                    $nomUser = selectUserById($revel->userid)['usuario']; 
                    $imagenUser = 'https://avatars.dicebear.com/api/avataaars/'.$nomUser.'.svg';
                   
            ?>         
                <div class="revel-en-muro">
                    <div class="revel-muro">
                        <div class="usuario">
                            <img src="<?=$imagenUser?>">
                            <p><?=$nomUser?></p>
                        </div>
                    </div>
                    <div class="contenido">
                        <?=$revel->texto;?>
                    </div>
                    <div class="botones">
                        <i class="fa-solid fa-trash" title="Borrar"></i>
                        <i class="fa-brands fa-gratipay" title="Fav"></i>
                        <i class="fa-solid fa-share" title="Compartir"></i>
                    </div>
                </div>   
                <?php } ?>
            </div>
        <?php 
            }
        ?>
        <?php include('inc/footer.inc.php'); ?>
    </body>
</html>