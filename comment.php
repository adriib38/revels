<?php

    require_once('inc/red/bd.inc.php');  
    require_once('inc/Comment.inc.php');
    require_once('inc/regex.inc.php');

    session_start();

    /**
     * Si existe el objeto user (Sesión iniciada)
     */
    if(isset($_SESSION['user'])){
        $sesionIniciada = true; 
    }else {
        header('Location: index.php');
        $sesionIniciada = false;
    }

    /**
     * Si llega un insert de comentario
     */
    if(isset($_POST)){
        //Valid el texto, crea e inserta un comentario
        if(preg_match($revelRegex, $_POST["textocomentario"])){
            $comment = new Comment(0, $_POST['idrevel'], $_SESSION['user']->id, $_POST['textocomentario'], 0);
            insertComments($comment);
            //Redirige al revel
            header('Location: revel.php?id='.$_POST['idrevel'].'');
        } else{
            require_once('inc/cabecera_logged.inc.php');
            echo '<h3 class=red>Escribe un comentario entre 1 y 290 caracteres.</h3>';
        } 
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Comentario - Rǝvels</title>
        
        <link rel="icon" type="image/x-icon" href="images/_logo.png">
        
        <meta http-equiv="expires" content="Sat, 07 feb 2016 00:00:00 GMT">

        <link rel="icon" type="image/x-icon" href="images/_logo.png">
        <script src="https://kit.fontawesome.com/92a45f44ad.js" crossorigin="anonymous"></script>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Montserrat:wght@300&family=Poppins:wght@500;600&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="styles\style.css">
    </head>

