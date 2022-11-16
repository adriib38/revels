<?php
    
    include('inc\red\bd.inc.php');  

    session_start();

    if(isset($_GET['id'])){
       
        $revel = selectRevel($_GET['id']);
        $user = selectUserById($revel->userid);
        $imagenUser = 'https://avatars.dicebear.com/api/avataaars/'.$user->usuario.'.svg';

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revel</title>

    <link rel="icon" type="image/x-icon" href="images/_logo.png">
    <script src="https://kit.fontawesome.com/92a45f44ad.js" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Poppins:wght@500;600&display=swap" rel="stylesheet"> 

    <link rel="stylesheet" href="styles\style.css">
</head>
    <body>
        <?php include('inc/cabecera_logged.inc.php'); ?>
        <div class="mrg-50">
            <div class="revel-en-muro">
                <div class="revel-muro">
                    <div class="usuario">
                    <img src="<?=$imagenUser??'' ?>">
                        <p><a href="list.php?id=<?=$user->id?>"><?=$user->usuario?></a></p>
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
        </div>
    </body>
</html>