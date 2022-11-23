<?php

    class Revel {
        public $id;
        public $userid;
        public $texto;
        public $fecha;
        public $comentarios;

        public function __construct($id, $userid, $texto, $fecha, $comentarios) {
            $this->id = $id;
            $this->userid = $userid;
            $this->texto = $texto;
            $this->fecha = $fecha;
            $this->comentarios = $comentarios;
        }
    }

?>