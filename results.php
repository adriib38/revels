<?php
    include('inc/Red-Objects.php');
   // include('inc/Red-Arrays.php');
    include('inc/sesion_pruebas.inc.php');  //BORRAR

    $idUser = $id_session_simulator;

    /**
    * recibe los datos del formulario de búsqueda de usuarios y mostrará una
    * lista de usuarios que coincidan con la búsqueda con un botón para seguir.
    */

    $resultadosEncontrados = false;

    //Buscamos usuarios. Aseguramos que lleguen respuestas 
    if(!empty($_GET)){
        $busqueda = trim($_GET["users"]);
        $resultado = $red->searchUsers($busqueda);
      
        if(!empty($resultado)){
            $resultadosEncontrados = true;
        }
    }

    //Seguir a usuario
    if(!empty($_POST)){
        $idASeguir = $_POST["idASeguir"];
        
        if($red->insertFollow($idUser, $idASeguir)){
        //if($red->insertFollow(6, 5)){
            $estado = "Siguiendo";
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
    
    <?php include('inc/cabecera_logged.inc.php'); ?>
    <div class="mrg-50">
    <!-- Si SI hay resultados 
    Se imprime una lista con los usuarios.
    -->
    <ul class="lista-resultados">
        <?php if($resultadosEncontrados){ 
        foreach($resultado as $user){
        ?>
            <li class="carta-usuario">
                <img src="https://avatars.dicebear.com/api/avataaars/<?= $user->name ?>.svg" alt="Avatar" style="width:15%">
                <div>
                    <h4><b><?= $user->name ?> </b></h4>
                    <p><?= $user->mail ?></p>
            
                    <!-- Boton seguir al usuario encontrado -->
                    <form action="#" method="post">
                        <input type="hidden" name="idASeguir" value="<?= $user->id ?>"> 
                        <input type="submit" class="btn-seguir" value="+ Seguir">
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