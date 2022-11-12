<?php

    include('inc/sesion_pruebas.inc.php');  //BORRAR
    include('inc\red\bd.inc.php');

    /**
     *  si no recibe datos mostrará un formulario para introducir una nueva revelación.
     *   Si recibe los datos del formulario anterior guardará la nueva revelación y redirigirá a
     *	la página de dicha revelación.
     */

    $idUser = $id_session_simulator;
    if($idUser != 0) {
        $sesionIniciada = true;
        $userIniciado = selectUserById($idUser);
    }

    if(!empty($_POST)){
        if($_POST["texto"] != '' || $_POST["texto"] != ' '){

        }else{
            $newRevel = new Revel(0, $userIniciado["id"], $_POST["texto"], 0);
            insertRevel($newRevel);
        }

    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New</title>

    <link rel="icon" type="image/x-icon" href="images/_logo.png">
    <script src="https://kit.fontawesome.com/92a45f44ad.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles\style.css">
</head>
<body>
    <?php
        include('inc/cabecera.inc.php'); 
        $img = 'https://avatars.dicebear.com/api/avataaars/'.$userIniciado["usuario"].'.svg';
    ?>   
    <h2>Nuevo Revel</h2>
    <div class="publicar-revel">
        <div class="usuario">
            <img src="<?=$img?>">
            <h3><?=$userIniciado["usuario"]?></h3>
        </div>
        <form action="#" method="post">
            <textarea name="texto" id="texto-nuevo-revel" placeholder="¿Qué está pasando?"></textarea>
            <input type="submit" id="publicar-revel" value="Revelar">
        <form>
    </div>
</body>
</html>