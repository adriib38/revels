<?php

//Expresiones regulares
    $usuario = '/^[a-zA-Z0-9]{3,}$/';   //Minimo 3 caracteres, numeros y letras
    $nombre = '/^[a-zA-Z]{3,}$/';   //Minimo 3 caracteres, letras
    $apellidos = '/^[a-zA-Z]{5,}$/';   //Minimo 5 caracteres, letras
    $dni = '/^\d{7,8}\w{1}$/';  //dni
    $direccion = '/^[a-zA-Z]{10,}$/';   //Minimo 10 caracteres, letras
    $telefono = '/^[0-9]{6,}$/';   //Minimo 6 caracteres, numero
    $mail = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';  //mail
    $fecha = '/^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$/'; // dd/mm/aaaa
    $contrasenya = '/^[a-zA-Z0-9]{8,}$/';   //Minimo 8 caracteres, numeros y letras
?>