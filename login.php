<?php
    require_once('inc/red/bd.inc.php');

    session_start();

    /**
     * Si la sesión está iniciada: se rediridige a index.php
     */
    if(isset($_SESSION['user'])){
        header('Location: index.php');
    }

    if(!empty($_POST)){  

        $id = login2($_POST["mail"], $_POST["contrasenya"]);
        if($id){
            /*
            * Sesión inciada correctamente
            */
            $usr = selectUserById($id);
            $_SESSION['user'] =  $usr;

            header('Location: index.php');
        } else {
            $mensajeInicioFallido = '<p class="red">Inicio fallido</p>';
        }
    }
    
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Revels</title>

        <link rel="stylesheet" href="styles/style.css">
        
    </head>
    <body>

        <?php include('inc/cabecera.inc.php'); ?>

        <div class="mrg-100">
            <div class="centrado">
                
                <h1>Login</h1>
                    <form method="post" action="#" class="form-auth bg-azul">
                        <input type="text" name="mail" placeholder="Mail" value="<?=$_POST['mail']??'' ?>">
                        <br>
                        <input type="password" name="contrasenya" placeholder="Contraseña" value="<?=$_POST['contrasenya']??'' ?>">
                        <br>
                        <input type="submit" value="Login">
                    </form>
                <?=$mensajeInicioFallido??'' ?>
                <p><a href="#">¿Olvidaste tu contraseña?</a></p>
                <br>
                <p>¿Eres nuevo?<a href="registro.php">Registrarse</a></p>
            </div>
        </div>
    
        <?php include('inc/footer.inc.php'); ?>
    </body>
</html>