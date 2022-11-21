<?php
    
    require_once('inc/red/bd.inc.php');  

    session_start();

    if(isset($_GET['id'])){
       
        $revel = selectRevel($_GET['id']);
        $usuario = selectUserById($revel->userid);

    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revel</title>

    <link rel="icon" type="image/x-icon" href="images/_logo.png">
    <script src="https://kit.fontawesome.com/92a45f44ad.js" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Montserrat:wght@300&family=Poppins:wght@500;600&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="styles\style.css">
</head>
    <body>
        <?php require_once('inc/cabecera_logged.inc.php'); 
                $imagenUsuario = 'https://avatars.dicebear.com/api/avataaars/'.$usuario->usuario.'.svg';
                $fecha = date_format(date_create($revel->fecha), "d/m/Y - H:i:s");
        ?>
        <div class="mrg-50">
            <div class="revel-muro">
                <div class="usuario">
                    <img src="<?=$imagenUsuario ?>">
                    <a href="list.php?id=<?=$usuario->id?>"><?=$usuario->usuario ?></a>  
                </div>
                <a href="revel.php?id=<?=$revel->id?>">
                    <div class="contenido">
                        <?=$revel->texto ?>
                        <br>
                        <span class="fecha"><?=$fecha ?></span>
                    </div>
                    <div class="botones">
                        <i class="fa-brands fa-gratipay" title="Fav"></i>
                        <i class="fa-solid fa-share" title="Compartir"></i>
                    </div>
                </a>
            </div>
            
            <h2>Comentar</h2>
            <form action="comment.php" method="post">
                <input type="hidden" name="idrevel" value="<?=$revel->id?>">
                <input type="text" name="textocomentario">

                <input type="submit" value="Enviar">
            </form>
            <?php
                $comments = selectCommentsFromRevel($revel->id);
                foreach($comments as $comment){
                    $usuario = selectUserById($comment->userid);
                    $imagenUsuario = 'https://avatars.dicebear.com/api/avataaars/'.$usuario->usuario.'.svg';
                    $fecha = date_format(date_create($comment->fecha), "d/m/Y - H:i:s");

                    ?>
                    <div class="comentario">
                        <img src="<?=$imagenUsuario ?>" width="50px">
                        <div class="content">
                            <a href="list.php?id=<?=$usuario->id?>"><?=$usuario->usuario ?></a>  
                            <p><?=$comment->texto ?></p>
                            <span class="fecha"><?=$fecha ?></span>
                        </div>
                    </div>
            <?php
                }
            ?>
        </div>

        </div>
    </body>
</html>