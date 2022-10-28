<?php
    include('inc/Red-Objects.php');
    include('inc/sesion_pruebas.inc.php');  //BORRAR

    $idUser = $id_session_simulator;
    
    //$_SESSION = "";
    
    /**
     * Comprobamos si hay sesión iniciada para mostrar "Bienvenida" o "Muro".
     * 
     */
    $sesionIniciada = false;
    if(!empty($_SESSION)){
        $sesionIniciada = true;

        $red = $_SESSION['red'];
       
       
        $userIniciado = $red->selectUserById($idUser);
       // print_r($userIniciado->name);
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rǝvels</title>
        
        <link rel="icon" type="image/x-icon" href="images/favicon.png">
        
        <meta http-equiv="expires" content="Sat, 07 feb 2016 00:00:00 GMT">

        <script src="https://kit.fontawesome.com/92a45f44ad.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="styles\style.css">
    </head>
    <body>

        <?php if(!$sesionIniciada) { ?>
            <!--
                BIENVENIDA Cuando no hay sesión iniciada
            -->
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
                Barra lateral con usuarios a los que sigue el logueado
            -->
            <?php include('inc/cabecera_logged.inc.php'); ?>
            
            <!--
                Slidebar usuarios seguidos
            -->
            <?php 
                $seguidos = $red->selectFollowsFromUser($idUser); 
                //print_r($seguidos);
            ?>         
            <nav id="slidebar-seguidos">
                <p>Seguidos</p>
                <hr>
                <ul>
                    <?php
                        foreach($seguidos as $seguido){
                            echo  '<li>'.$seguido->name.'</li>';
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
            <?php
                $revels = $red->selectRevelsFromUser($idUser); 
                //print_r($revels[1]);
                foreach($revels as $revel){
                    $userId = $revel->userId;
                    $nomUser = $red->selectUserById($userId); 
                    $nomUser = ($nomUser->name);
            ?>         
                <div class="revel-en-muro">
                    <div class="revel-muro">
                        <div class="usuario">
                            <img src="images/user-1.png">
                            <p><?=$nomUser?></p>
                        </div>
                    </div>
                    <div class="contenido">
                        <?=  $revel->text; ?>
                    </div>
                </div>   
                <?php 
                    }
                ?>
            </div>
        <?php 
            }
        ?>
        <?php include('inc/footer.inc.php'); ?>
    </body>
</html>