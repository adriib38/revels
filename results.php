<?php
    require_once('inc/red/bd.inc.php');  

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
    * recibe los datos del formulario de búsqueda de usuarios y mostrará una
    * lista de usuarios que coincidan con la búsqueda con un botón para seguir.
    */

    $resultadosEncontrados = false;
    //Buscamos usuarios. Aseguramos que lleguen respuestas 
    if(!empty($_GET)){
        $busqueda = trim($_GET["users"]);
        $resultado = searchUsers($busqueda);
      
        if(!empty($resultado)){
            $resultadosEncontrados = true;
        }
    }

    //Seguir a usuario
    if(!empty($_POST['follow'])){
        $idASeguir = $_POST["idASeguir"];
        
        if(insertFollow($_SESSION['user']->id, $idASeguir)){
            $estado = "Siguiendo";
        } else {
            $estado = "Error";
        }
        echo $estado;        
    }

     //Dejar de seguir a usuario
     if(!empty($_POST['unfollow'])){
        $idAUnfollow = $_POST["idASeguir"];
        
        if(deleteFollow($_SESSION['user']->id, $idAUnfollow)){
            $estado = "Unfollow";
        } else {
            $estado = "Error";
        }
        echo $estado;        
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados - Revels</title>

    <script src="https://kit.fontawesome.com/92a45f44ad.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles\style.css">

</head>
<body>
    
    <?php require_once('inc/cabecera_logged.inc.php'); ?>
    <div class="mrg-50">
    <!-- Si SI hay resultados 
    Se imprime una lista con los usuarios.
    -->
    <ul class="lista-resultados">
        <?php if($resultadosEncontrados){ 
           
        $seguidos = selectIdFollowsFromUser($_SESSION['user']->id);

        foreach($resultado as $user){ ?>
            <li class="carta-usuario">
                <img src="https://avatars.dicebear.com/api/avataaars/<?=$user->usuario?>.svg?b=%232e3436" alt="Avatar" style="width:15%">
                <div>
                    <h4><b><?=$user->usuario ?> </b></h4>
                    <p><?=$user->email?></p>
            
                    <!-- Boton seguir al usuario encontrado -->
                    <form action="#" method="post">
                        <?php 
                            if($_SESSION['user']->id != $user->id){
                                echo '<input type="hidden" name="idASeguir" value="'.$user->id.'">'; 
                                if(!in_array($user->id, $seguidos)){
                                    echo '<input type="submit" class="btn-seguir" name="follow" value="+ Seguir">';
                                }else{
                                    echo '<input type="submit" class="btn-unfollow" name="unfollow" value="Unfollow">';
                                }     
                            }else{
                                echo 'Yo';
                            }
                        ?>
                        
                    </form>
                </div>
            </li> 
        <?php } ?>
    </ul>
    <!-- Si NO hay resultados -->
    <?php } if(!$resultadosEncontrados){ ?> 
        <h2>No hay usuarios con ese nombre: <?= $busqueda ??'' ?></h2>
    <?php } ?>
    
    </div>

</body>
</html>