<?php
  
    $user = 'revel';
    $password = 'lever';
    $bdName = 'revels';
    $host = 'localhost';
    $port = '3306';


    //Información de la base de datos
    $dsn = 'mysql:host='.$host.';port='.$port.';dbname='.$bdName.'';          
    $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');


    function todosLosUsuarios(){
        
            
        $user = 'revel';
        $password = 'lever';
        $bdName = 'revels';
        $host = 'localhost';
        $port = '3306';


        //Información de la base de datos
        $dsn = 'mysql:host='.$host.';port='.$port.';dbname='.$bdName.'';          
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');


        $conexion = new PDO($dsn, $user, $password, $opciones);
        
        //Consulta SELECT
        $resultado = $conexion->query('SELECT * FROM `users` WHERE 1;');

        $consulta->execute();

        print_r($resultado);
       
    }

?>