
<?php
    //include('inc/Red-Objects.php');
    include('inc\red\bd.inc.php');

    include('inc/regex.inc.php');
    include('inc/sesion_pruebas.inc.php');  //BORRAR
    /**
     * mostrará una lista de todas las revelaciones escritas por el usuario junto con un
     * botón para poder eliminar cada una de ellas.
     * 
     * 
     */

    $idUser = $id_session_simulator;
    if($idUser != 0) {
        $sesionIniciada = true;
        $userIniciado = selectUserById($idUser);
    }

    
    $existeElUsuario = false;
    $perfilDelUsuarioLogeado = false;

    if(!empty($_GET)){
        //Se muestra el perfil del usuario llegado por $_GET.
        //Accede al usuario y comprueba si existe.
        if($usuarioMostrar = selectUserById($_GET["id"])) { $existeElUsuario = true; }
        $perfilDelUsuarioLogeado = false;
    } else {
        //Se mostrará el perfil del usuario logeado.
        $existeElUsuario = true;
        $usuarioMostrar = selectUserById($userIniciado["id"]);
        $perfilDelUsuarioLogeado = true;
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

        <script src="https://kit.fontawesome.com/92a45f44ad.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="styles\style.css">
    </head>
    <body>
        <?php include('inc/cabecera_logged.inc.php'); ?>
       

        <?php 
            if(!$existeElUsuario){
                echo 'No encontrado.';
            }
         
            if($existeElUsuario){
        ?>

        <div class="perfil-cabecera">
            <img src="https://avatars.dicebear.com/api/avataaars/<?=$usuarioMostrar["usuario"]?>.svg" class="img-perfil">
            <h2 class="nombre"><?= $usuarioMostrar['usuario'] ?></h2>
            <?php if($perfilDelUsuarioLogeado){ echo '<i class="fa-solid fa-pencil"></i><a href="account.php">Editar</a>'; }?>
        </div>
        
        <!-- 
            MURO
            Los revels del usuario loegueado
        -->
        <div class="muro">
            <h2>Últimos Rǝvels</h2>
            <div class="underline"></div>
           
            <?php
                $revels = selectRevelsFromUser($usuarioMostrar["id"]); 
                //print_r($revels[1]);
                foreach($revels as $revel){
                    $userId = $revel->id;
                    $nomUser = selectUserById($revel->userid)['usuario']; 
                    $imagenUser = 'https://avatars.dicebear.com/api/avataaars/'.$nomUser.'.svg';
                    ?>         
                    <div class="revel-en-muro">
                            <div class="revel-muro">
                                <div class="usuario">
                                    <img src="<?=$imagenUser?>">
                                    <p><?=$nomUser?></p>
                                </div>
                            </div>
                            <div class="contenido">
                                <?=$revel->texto;?>
                            </div>
                            <div class="botones">
                                <i class="fa-solid fa-trash" title="Borrar"></i>
                                <i class="fa-brands fa-gratipay" title="Fav"></i>
                                <i class="fa-solid fa-share" title="Compartir"></i>
                            </div>
                        </div>   
                <?php } ?>
        </div>
        <?php } ?>


        <?php include('inc/footer.inc.php'); ?>
    </body>
    
</html>