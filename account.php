
<?php

    include('inc\red\bd.inc.php');

    include('inc/regex.inc.php');

    session_start();

    if(isset($_SESSION['user'])){
        print_r($_SESSION);
        $sesionIniciada = true;
        
    }else {
        echo 'NO INICIADA';
        $sesionIniciada = false;
    }

/**
 * si no recibe datos mostrará un formulario cumplimentado con los datos del 
 * usuario para poder modificarlos. Si recibe datos de dicho formulario los almacenará.
 * 
 */

 /**
  * Solo se actualizarán los atributios que el usuario escriba,
  * menos la contraseña, que siempre debe cambiar.
  *
  */
    
    //Campos de los nuevos valores, son los mismos que ahora, por si no se cambian.
    $viejoId = $_SESSION['user']->id;
    $nuevoNombre = $_SESSION['user']->usuario;
    $nuevaContrasenya = $_SESSION['user']->contrasenya;
    $nuevoMail = $_SESSION['user']->email;


    if(!empty($_POST)){
        //Si el usuario ha escrito en un campo pero no cumple sintacticamente, no se actualizará.
        $hayErrores = false;

        //Si el campo del nombre no está vacío, se actualizará el nombre.
        if(!empty($_POST["nombre"])){
            if(!preg_match($nombre, $_POST["nombre"] )){
                $errorNombre = '<br><span class="red"> -Nombre no valido</span>';
                $hayErrores = true;
            }else{
                $nuevoNombre = $_POST["nombre"];
            }
        }
     
        if(!preg_match($contrasenya, $_POST["contrasenya"] )){
            $errorContrasenya = '<br><span class="red"> -Contraseña no valida, mínimo 8 caracteres, numeros y letras</span>';
            $hayErrores = true;
        }else{
            $nuevaContrasenya = $_POST["contrasenya"];
        }

        if(!empty($_POST["mail"])){
            if(!preg_match($mail, $_POST["mail"] )){
                $errorMail = '<br><span class="red"> -Mail no valido</span>';
                $hayErrores = true;
            }else{
                $nuevoMail = $_POST["mail"];
            }
        }

        if(!$hayErrores){
            $passEncriptada = password_hash($nuevaContrasenya, PASSWORD_DEFAULT);
            $newUser = new User($viejoId, $nuevoNombre, $passEncriptada, $nuevoMail);
            $seHaActualizado = updateUser($newUser);
            if($seHaActualizado){
                $estado = '<br><span class="green"> ¡Perfil actualizado!</span>';
               
            }
        }


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
    <body class="bg-gris">
        <?php include('inc/cabecera_logged.inc.php'); ?>
       
        <div class="mrg-50">

            <!-- FORMULARIO Actualizar -->  
            <form action="#" method="post" class="form-auth form-actualizar bg-blanco">
                <h2 id="actualizar-perfil">Actualizar perfil</h2>
                <label>Nuevo nombre:</label>
                <br>
                <input type="text" name="nombre" placeholder="Nombre" value="<?=$_POST['nombre']??'' ?>">
                <?=$errorNombre??'' ?>
                <br>
                <label>Nuevo mail:</label>
                <br>
                <input type="text" name="mail" placeholder="Mail" value="<?=$_POST['mail']??'' ?>">
                <?=$errorMail??'' ?>
                <br>
                <label class="required">Confirmar o cambiar contraseña:</label>
                <br>
                <input class="required" type="password" required name="contrasenya" placeholder="">
                <?=$errorContrasenya??'' ?>
                <br>
                <input type="submit" value="Actualizar">
                <?=$estado??'' ?> 
            </form>
        </div>

        <?php include('inc/footer.inc.php'); ?>
    </body>
    
</html>