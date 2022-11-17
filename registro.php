<?php

    require_once('inc/red/bd.inc.php');
    require_once('inc/regex.inc.php');

    $hayErrores = false;

    $formularioEnviado = false;

    $contrasenyaValor = '';
    $repContrasenya = '';

    //Aseguramos que lleguen respuestas antes de validarlas
    if(!empty($_POST)){

        if(!preg_match($nombre, $_POST["nombre"] )){
            $errorNombre = '<br><span class="red"> -Nombre no valido</span>';
            $hayErrores = true;
        }

        if(!preg_match($mail, $_POST["mail"] )){
            $errorMail = '<br><span class="red"> -Mail no valido</span>';
            $hayErrores = true;
        }

        if(!preg_match($contrasenya, $_POST["contrasenya"] )){
            $errorContrasenya = '<br><span class="red"> -Contraseña no valida, mínimo 8 caracteres, numeros y letras</span>';
            $contrasenyaValor = $_POST["contrasenya"];
            $hayErrores = true;
        }

        if(!preg_match($fecha, $_POST["fecha-nacimiento"] )){
            $errorFecha = '<br><span class="red"> -Fecha no valida</span>';
            $hayErrores = true;
        }

        $contrasenyaValor = $_POST["contrasenya"];
        $repContrasenya = $_POST["rep-contrasenya"];
        if($contrasenyaValor != $repContrasenya){
            $errorRepContrasenya = '<br><span class="red"> Las contraseñas no coinciden</span>';
            $hayErrores = true;
        }

        if(!$hayErrores){
            $passEncriptada = password_hash($_POST["contrasenya"], PASSWORD_DEFAULT);
            $newUser = new User(0, $_POST["nombre"], $passEncriptada, $_POST["mail"]);
            insertUser($newUser);
        }

    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro - Revels</title>

        <link rel="stylesheet" href="styles/style.css">
        
    </head>
    <body>
        
        <?php require_once('inc/cabecera.inc.php'); ?>
      
        <div class="mrg-100">
            <div class="centrado">
                
                <h1>Registro</h1>
                    <form method="post" action="#" class="form-auth bg-amarillo">
                        <input type="text" name="nombre" placeholder="Nombre" value="<?=$_POST['nombre']??'' ?>">
                        <?=$errorNombre??'' ?>
                        <br>
                        <input type="text" name="mail" placeholder="Mail" value="<?=$_POST['mail']??'' ?>">
                        <?=$errorMail??'' ?>
                        <br>
                        <input type="password" name="contrasenya" placeholder="Contraseña" value="<?=$_POST['contrasenya']??'' ?>">
                        <?=$errorContrasenya??'' ?>
                        <br>
                        <input type="password" name="rep-contrasenya" placeholder="Repetir contaseña" value="<?=$_POST['rep-contrasenya']??'' ?>">
                        <?=$errorRepContrasenya??'' ?>
                        <br>
                        <input type="text" name="fecha-nacimiento" placeholder="Fecha de nacimiento" value="<?=$_POST['fecha-nacimiento']??'' ?>">
                        <?=$errorFecha??'' ?>
                        <br>
                        <input type="submit" value="Registrar">
                    </form>
                <p><a href="#">¿Olvidaste tu contraseña?</a></p>
                <br>
                <p>¿Ya tienes cuenta? <a href="login.php">Login</a><p>
            </div>
        </div>

        <?php require_once('inc/footer.inc.php'); ?>
    </body>
</html>