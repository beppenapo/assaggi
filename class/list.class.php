<?php
session_start();
require("db.class.php");
class Lista extends Db{
    public $out;
    function __construct($f){$this->$f();}

    private function titolo(){
        $sql = "select id,copertina,titolo,isbn,editore,anno,pagine,tag,descrizione,inserimento from libri order by inserimento desc, titolo asc;";
        $list = $this->simpleSql($sql);
        $this->out = json_encode($list);
    }
    private function autore(){}
    private function immagini(){}
}

?>
