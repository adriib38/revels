<?php
    class Red {
        private $user = 'revel';
        private $password = 'lever';
        private $bdName = 'revels';
        private $host = 'localhost';
        private $port = '3306';
    
        //Información de la base de datos
        private $dsn = 'mysql:host='.$host.';port='.$port.';dbname='.$bdName.'';          
        private $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

        public function todosLosUsuarios(){

            $conexion = new PDO($dsn, $user, $password, $opciones);
            
            //Consulta SELECT
            $resultado = $conexion->query('SELECT * FROM `users` WHERE 1;');
            unset($conexion);
            
            $usuarios = $resultado->fetch();
            print_r($usuarios);
           
        }
    }


   


 

    function selectUserById($id){

    }

?>