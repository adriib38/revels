<?php

    class User {
        public $id;
        public $usuario;
        public $contrasenya;
        public $email;

        public function __construct($id, $usuario, $contrasenya, $email) {
            $this->id = $id;
            $this->usuario = $usuario;
            $this->contrasenya = $contrasenya;
            $this->email = $email;
        }
    }

?>