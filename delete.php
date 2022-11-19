<?php

    require_once('inc/red/bd.inc.php');  

    session_start();

    $id = $_SESSION['user']->id;
    /**
     * Si no existe el objeto user (sesión no iniciada) redirige
     */
    if(!isset($_SESSION['user'])){
       header('Location: index.php');
    }

    /**
     * Si el id del usuario iniciado y el del autor del revel no es el mismo
     * no se elminima
     */
    if($_SESSION['user']->id != selectRevel($_GET['id'])->userid){
        header('Location: list.php?id='.$id.'');
    }else{
        if(isset($_GET)){
            deleteRevel($_GET['id']);
    
            $comments = selectCommentsFromRevel($_GET['id']);
            foreach($comments as $comment){
                deleteComment($comment->id);
            }
        }
        header('Location: list.php?id='.$id.'');    
    }


?>