<?php

    require_once('inc/red/bd.inc.php');  

    session_start();

    /**
     * Si existe el objeto user (Sesión iniciada)
     */
    if(isset($_SESSION['user'])){
        $sesionIniciada = true; 
    }else {
        $sesionIniciada = false;
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

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Montserrat:wght@300&family=Poppins:wght@500;600&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="styles\style.css">
    </head>
    <body>

        <?php 
            if(!$sesionIniciada) { 
                // BIENVENIDA Cuando no hay sesión iniciada
                require_once('inc/cabecera.inc.php');
                include('inc/bienvenida.inc.php');
            }
        ?>
            
        <?php 
        /**
         * Si la sesión está iniciada, se muestra el muro de revel del usuario.
         */
        if($sesionIniciada){ 
            require_once('inc/cabecera_logged.inc.php');
            $id = $_SESSION['user']->id;
            $seguidos = selectFollowsFromUser($id); 
        ?>
            <!-- Aside seguidos -->
            <nav id="slidebar-seguidos">
                <p>Seguidos</p>
                <hr>
                <ul>
                    <?php
                        if(count($seguidos) == 0) { 
                            echo "<li>Aún no sigues a nadie</li>"; 
                        }else{
                            foreach($seguidos as $seguido){
                                echo  '<li><a href="list.php?id='.$seguido->id.'"> '.$seguido->usuario.'</a></li>';
                            }
                        }                      
                    ?>
                </ul>
            </nav>

            <!-- 
                NUEVO REVEL
            -->
            <div class="muro">
                <h2>Nuevo rǝvel</h2>
                <div class="underline"></div>
                <div id="nuevo-revel-acceso">
                    <div class="usuario">
                        <img src="https://avatars.dicebear.com/api/avataaars/<?=$_SESSION['user']->usuario?>.svg?b=%232e3436">
                        <a href="list.php?id=<?=$_SESSION['user']->id?>"><?=$_SESSION['user']->usuario ?></a>  
                    </div>
                    <div>
                    <a href="new.php">
                        <p><i class="fa-solid fa-feather"></i>Nuevo revel</p>
                        </a>
                    </div>
                </div>
            </div>

            <!-- 
                Muro de revels de seguidos
            -->
            <div class="muro">
                <h2>Últimos Rǝvels</h2>
                <div class="underline"></div>
                    
                <?php
                    $muro = array();
                    
                    //Almacena revels
                    $muro = selectRevelsMuro($_SESSION['user']->id);
                   
                    //Imprime revels de muro
                    foreach($muro as $revel){    
                        $usuario = selectUserById($revel->userid);
                        $imagenUsuario = 'https://avatars.dicebear.com/api/avataaars/'.$usuario->usuario.'.svg?b=%232e3436';
                        $fecha = date_format(date_create($revel->fecha), "d/m/Y - H:i");
                ?>
              
                    <div class="revel-muro">
                        <div class="usuario">
                            <img src="<?=$imagenUsuario ?>">
                            <a href="list.php?id=<?=$usuario->id?>"><?=$usuario->usuario ?></a>  
                        </div>
                        <a href="revel.php?id=<?=$revel->id?>">
                            <div class="contenido">
                                <?=$revel->texto ?>
                                <br>
                                <span class="fecha"><?=$fecha ?></span>
                            </div>
                            <div class="botones">
                                <i class="fa-solid fa-share" title="Comentar"></i>
                                <span><?=$revel->comentarios??'' ?></span>
                            </div>
                        </a>
                    </div>
        <?php 
           }
        //Fin si la sesión está iniciada.
            }
        ?>
        <?php require_once('inc/footer.inc.php'); ?>
    </body>
</html>