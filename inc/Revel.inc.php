<?php

    class Revel {
        public $id;
        public $userid;
        public $texto;
        public $fecha;

        public function __construct($id, $userid, $texto, $fecha) {
            $this->id = $id;
            $this->userid = $userid;
            $this->texto = $texto;
            $this->fecha = $fecha;
        }
    }

?>