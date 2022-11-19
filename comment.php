<?php

    require_once('inc/red/bd.inc.php');  
    require_once('inc/Comment.inc.php');

    session_start();

    if(isset($_POST)){
        //Crea e inserta un comentario
        $comment = new Comment(0, $_POST['idrevel'], $_SESSION['user']->id, $_POST['textocomentario'], 0);
        insertComments($comment);

        header('Location: revel.php?id='.$_POST['idrevel'].'');
    }
?>
