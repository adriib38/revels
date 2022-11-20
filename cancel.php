<?php

/**
* si no recibe datos mostrará un formulario con un aviso de confirmación de
* eliminación de la cuenta con un checkbox y un botón para aceptar. Si se pulsa el
* botón de aceptar se enviarán los datos a la propia página. Si se reciben los datos
* del formulario de confirmación se eliminará al usuario, sus revelaciones y los
* comentarios a estas y se cerrará la sesión y redirigirá a la página index
*/

    require_once('inc/red/bd.inc.php');  

    session_start();

    /**
     * Si no existe el objeto user (sesión no iniciada) redirige
     */
   
    if(isset($_POST['check'])){
        $id = $_SESSION['user']->id;     

        $revels = selectRevelsForUser($_SESSION['user']->id);
        foreach($revels as $revel){
            $comments = selectCommentsFromRevel($revel->id);
            foreach($comments as $comment){
                deleteComment($comment->id);
            }
            deleteRevel($revel->id);
        }

          try{
            if(deleteUser($id)){
                echo 'Eliminada';
            }
        }catch(Exception $e){
          
        }

       // header('Location: cancel.php');    
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="icon" type="image/x-icon" href="images/_logo.png">
    <script src="https://kit.fontawesome.com/92a45f44ad.js" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Poppins:wght@500;600&display=swap" rel="stylesheet"> 

    <link rel="stylesheet" href="styles\style.css">
</head>
<body>
    <?php
        require_once('inc/cabecera_logged.inc.php');
    ?> 
    <h2>Seguro que desea eliminar su cuenta?</h2>
    <form action="#" method="post">
        <input type="checkbox" name="check">
        <input type="submit" value="Eliminar">
    </form>
</body>
</html>