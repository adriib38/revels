<?php
    /**
     * Objeto Coment. Para comentarios de un revel.
     */
    class Comment {
        public $id;
        public $revelid;
        public $userid;
        public $texto;
        public $fecha;

        public function __construct($id, $revelid, $userid, $texto, $fecha) {
            $this->id = $id;
            $this->revelid = $revelid;
            $this->userid = $userid;
            $this->texto = $texto;
            $this->fecha = $fecha;
        }
    }

?>