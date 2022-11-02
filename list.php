
<?php
    include('inc/Red-Objects.php');
    include('inc/regex.inc.php');
    include('inc/sesion_pruebas.inc.php');  //BORRAR
/**
 * mostrará una lista de todas las revelaciones escritas por el usuario junto con un
 * botón para poder eliminar cada una de ellas.
 * 
 * 
 */

    $idUser = $id_session_simulator;

    $red = $_SESSION['red'];    
        
    $userIniciado = $red->selectUserById($idUser);

    if(!empty($_POST)){

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
       
        <div class="perfil-cabecera">
            <img src="https://avatars.dicebear.com/api/avataaars/<?= $userIniciado->name ?>.svg" class="img-perfil">
            <h2 class="nombre"><?= $userIniciado->name ?></h2>
        </div>
        
        <!-- 
            MURO
            Los revels del usuario loegueado
        -->
        <div class="muro">
            <h2>Tus Rǝvels</h2>
            <div class="underline"></div>

           
            <?php
                $revels = $red->selectRevelsFromUser($idUser); 
                //print_r($revels[1]);
                foreach($revels as $revel){
                    $userId = $revel->userId;
                    $nomUser = $red->selectUserById($userId); 
                    $nomUser = ($nomUser->name);
            ?>         
            <div class="revel-en-muro">
                <div class="revel-muro">
                    <div class="usuario">
                        <img src="https://avatars.dicebear.com/api/avataaars/<?= $userIniciado->name ?>.svg">
                        <p><?= $nomUser ?></p>
                    </div>
                </div>
                <div class="contenido">
                    <?= $revel->text; ?>
                </div>
                <div class="botones">
                    <i class="fa-solid fa-trash" title="Borrar"></i>
                    <i class="fa-brands fa-gratipay" title="Fav"></i>
                    <i class="fa-solid fa-share" title="Compartir"></i>
                </div>
            </div>   
          <?php } ?>
        </div>



        <?php include('inc/footer.inc.php'); ?>
    </body>
    
</html>