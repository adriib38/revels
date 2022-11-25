
<?php

    /**
     * si no recibe datos mostrará un formulario cumplimentado con los datos del 
     * usuario para poder modificarlos. Si recibe datos de dicho formulario los almacenará.
     */

    require_once('inc/red/bd.inc.php');
    require_once('inc/regex.inc.php');

    session_start();

    /**
     * Si existe el objeto user (Sesión iniciada) 
     * Si no existe redirige a index.php
     */
    if(isset($_SESSION['user'])){
        $sesionIniciada = true; 
    }else {
        header('Location: index.php');
        $sesionIniciada = false;
    }
    
    //Campos de los nuevos valores, son los mismos que ahora, por si no se cambian.
    $viejoId = $_SESSION['user']->id;
    $nuevoNombre = $_SESSION['user']->usuario;
    $nuevaContrasenya = $_SESSION['user']->contrasenya;
    $nuevoMail = $_SESSION['user']->email;
    $errorDatosExisten = false;
    $contrasenyasCoinciden = false;

    if(!empty($_POST)){
        //Si el usuario ha escrito en un campo pero no cumple sintacticamente, no se actualizará.
        $hayErrores = false;

        //Si el campo del nombre no está vacío, se actualizará el nombre.
        if(!empty($_POST["nombre"])){
                      //Comprueba que sea valido
            if(!preg_match($nombre, $_POST["nombre"] )){
                $errorNombre = '<br><span class="red"> -Nombre no valido</span>';
                $hayErrores = true;
            }else{
                //Compruebas si existe un usario con el mismo nombre
                if(selectUserByUserName($_POST["nombre"])){
                    $errorNombre = '<br><span class="red"> Ya existe un usuario con ese nombre.</span>';
                    $errorDatosExisten = true;
                }
            }
        }
     
        //Si el campo del email no está vacío, se actualizará el nombre.
        if(!empty($_POST["mail"])){
            //Comprueba que sea valido
            if(!preg_match($mail, $_POST["mail"] )){
                $errorMail = '<br><span class="red"> -Mail no valido</span>';
                $hayErrores = true;
            }else{
                //Comprueba si existe un usuario con el mismo email
                if(selectUserByEmail($_POST["mail"])){
                    $errorMail = '<br><span class="red"> Ya existe un usuario con ese mail.</span>';
                    $errorDatosExisten = true; 
                }
            }
        }

        //Comprueba si la contrasenya es valida
        if(!preg_match($contrasenya, $_POST["contrasenya"] )){
            $errorContrasenya = '<br><span class="red"> -Contraseña no valida, mínimo 6 caracteres, numeros y letras</span>';
            $hayErrores = true;
        }else{
            //Comprueba que la contrasenya sea igual que la confirmación
            if($_POST["contrasenya"] == $_POST['contrasenya-rep']){
                $nuevaContrasenya = $_POST["contrasenya"];
                $contrasenyasCoinciden = true;
            }else{
               $errorContrasenya =  '<br><span class="red"> -Las contrasenyas no coinciden</span>';
            }
        }
       
        //Si no hay errores en los datos insertados se actualizará el usuario y se cerrará sesión.
        if(!$hayErrores){
            //Si las contrasenyas coinicen y los datos no existen
            if($contrasenyasCoinciden AND !$errorDatosExisten){
                $passEncriptada = password_hash($nuevaContrasenya, PASSWORD_DEFAULT);
                $newUser = new User($viejoId, $nuevoNombre, $passEncriptada, $nuevoMail);
                $seHaActualizado = updateUser($newUser);
                if($seHaActualizado){
                    $estado = '<br><span class="green"> ¡Perfil actualizado!</span>';
                }
                session_destroy();
                
                header('Location: close.php');
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
                <h2 id="actualizar-perfil">Actualizar cuenta</h2>
                <label>Si no vas a cambiar un campo dejalo vacío.</label>
                <br>
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
                <label>Confirmar o cambiar contraseña</label>
                <br>
                <label class="required">Contraseña:</label>
                <br>
                <input class="required" type="password" required name="contrasenya" placeholder="">
                <?=$errorContrasenya??'' ?>
                <br>
                <label class="required">Confirmar contraseña:</label>
                <br>
                <input class="required" type="password" required name="contrasenya-rep" placeholder="">
                <br>
                <input type="submit" value="Actualizar">
                <?=$estado??'' ?> 
            </form>
            <p><a href="list.php">Mis revels</a></p>
            <br>
            <p class="red"><a href="cancel.php">Eliminar cuenta</a></p>
        </div>

        <?php include('inc/footer.inc.php'); ?>
    </body>
    
</html>