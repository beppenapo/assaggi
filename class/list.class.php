<?php
session_start();
require("db.class.php");
class Lista extends Db{
    public $out;
    function __construct($f){$this->$f();}

    private function lista(){
        $sql = "select l.id,l.copertina,l.titolo,l.isbn,l.editore,l.anno,l.pagine,l.tag,l.descrizione,l.inserimento, json_agg(trim(a.cognome ||' '||coalesce(a.nome,''))) as autore from libri l, authbook ab, autori a  where ab.libro = l.id and ab.autore = a.id group by l.id order by inserimento desc, titolo asc;";
        $list = $this->simpleSql($sql);
        $this->out = json_encode($list);
    }
    private function filtroAutore(){
        $sql = "select distinct substr(cognome, 1, 1) as lista from autori order by 1 asc;";
        $this->out = json_encode($this->simpleSql($sql));
    }
    private function autori(){
        $sql = "select * from autori order by cognome asc;";
        $this->out = json_encode($this->simpleSql($sql));
    }
    private function immagini(){}
}

?>
