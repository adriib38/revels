
<?php

    require_once('inc/red/bd.inc.php');
    require_once('inc/regex.inc.php');

    session_start();

    if(isset($_SESSION['user'])){
        print_r($_SESSION);
        $sesionIniciada = true;
        
    }else {
        echo 'NO INICIADA';
        $sesionIniciada = false;
    }

    /**
     * mostrará una lista de todas las revelaciones escritas por el usuario junto con un
     * botón para poder eliminar cada una de ellas.
     * 
     * 
     */

    $existeElUsuario = false;
    $perfilDelUsuarioLogeado = false;

    if(!empty($_GET)){
        //Se muestra el perfil del usuario llegado por $_GET.
        //Accede al usuario y comprueba si existe.
        if($usuarioMostrar = selectUserById($_GET["id"])) { $existeElUsuario = true; }
        print_r($usuarioMostrar);
        $perfilDelUsuarioLogeado = false;
        if($_GET['id'] == $_SESSION['user']->id){
            $perfilDelUsuarioLogeado = true;
        }
    } else {
        //Se mostrará el perfil del usuario logeado.
        $existeElUsuario = true;
        $usuarioMostrar = $_SESSION['user'];
        $perfilDelUsuarioLogeado = true;
    }

    

    //Follow y unfollow
    if(isset($_GET['unfollow'])){
        deleteFollow($_SESSION['user']->id, $_GET['unfollow']);
        header('Location: list.php?id='.$_GET['unfollow'].'');
    }else if(isset($_GET['follow'])){
        insertFollow($_SESSION['user']->id, $_GET['follow']);
        header('Location: list.php?id='.$_GET['follow'].'');
    }

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cuenta - Rǝvels</title>
        
        <link rel="icon" type="image/x-icon" href="images/_logo.png">
        
        <meta http-equiv="expires" content="Sat, 07 feb 2016 00:00:00 GMT">

        <link rel="icon" type="image/x-icon" href="images/_logo.png">
        <script src="https://kit.fontawesome.com/92a45f44ad.js" crossorigin="anonymous"></script>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Poppins:wght@500;600&display=swap" rel="stylesheet"> 

        <link rel="stylesheet" href="styles\style.css">
    </head>
    <body>
        <?php require_once('inc/cabecera_logged.inc.php'); ?>
       
        <?php 
            if(!$existeElUsuario){
                echo 'No encontrado.';
            }
         
            if($existeElUsuario){
        ?>

        <div class="perfil-cabecera">
            <img src="https://avatars.dicebear.com/api/avataaars/<?=$usuarioMostrar->usuario ?>.svg" class="img-perfil">
            <h2 class="nombre"><?= $usuarioMostrar->usuario ?></h2>
            <?php 
                if($perfilDelUsuarioLogeado){ 
                    echo '<i class="fa-solid fa-pencil"></i><a href="account.php">Editar</a>'; 
                }
            ?>
            <?php 
                if(!$perfilDelUsuarioLogeado){ 
                    if(leSigue($usuarioMostrar->id, $_SESSION['user']->id)){
                        echo '<a href="list.php?unfollow='.$usuarioMostrar->id.'">Unfollow</a>'; 
                    }else{
                        echo '<a href="list.php?follow='.$usuarioMostrar->id.'">Seguir</a>'; 
                    }
                }
            ?>
        </div>
        
        
        <!-- 
            MURO
            Los revels del usuario loegueado
        -->
        <div class="muro">
            <h2>Últimos Rǝvels</h2>
            <div class="underline"></div>
       
            <?php
                $revels = selectRevelsFromUser($usuarioMostrar->id); 

                foreach($revels as $revel){
                    $usuario = selectUserById($revel->userid);
                    $imagenUsuario = 'https://avatars.dicebear.com/api/avataaars/'.$usuario->usuario.'.svg';
                    $fecha = date_format(date_create($revel->fecha), "d/m/Y - H:i:s");
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
                        </a>
                            <div class="botones">
                                <i class="fa-brands fa-gratipay" title="Fav"></i>
                                <i class="fa-solid fa-share" title="Compartir"></i>
                                <?php
                                    if($perfilDelUsuarioLogeado){
                                        echo '<a href="delete.php?id='.$revel->id.'"><i class="fa-solid fa-trash" title="Compartir"></i></a>';
                                    }
                                ?>
                            </div>
                      
                    </div>
                <?php } ?>
        </div>
        <?php } ?>

        <?php require_once('inc/footer.inc.php'); ?>
    </body>
    
</html>