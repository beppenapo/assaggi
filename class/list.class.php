<?php
session_start();
require("db.class.php");
class Lista extends Db{
    function __construct(){}

    public function lista(){
        $sql="select l.id,l.copertina,l.titolo,l.isbn,l.editore,l.anno,l.pagine,l.tag,l.descrizione,l.inserimento, json_agg(trim(a.cognome ||' '||coalesce(a.nome,''))) as autore from libri l, authbook ab, autori a  where ab.libro = l.id and ab.autore = a.id group by l.id order by inserimento desc, titolo asc;";
        return json_encode($this->simpleSql($sql));
    }
    public function filtroAutore(){
        return json_encode($this->simpleSql("select distinct substr(cognome, 1, 1) as lista from autori order by 1 asc;"));
    }
    public function autori(){
        return json_encode($this->simpleSql("select * from autori order by cognome asc;"));
    }
    public function img(){
        $sql="select l.id,l.copertina,l.titolo, substr(l.descrizione,0,200)||' ...' as descrizione, json_agg(trim(a.cognome ||' '||coalesce(a.nome,''))) as autore from libri l, authbook ab, autori a  where ab.libro = l.id and ab.autore = a.id group by l.id order by l.inserimento desc, titolo asc;";
        return json_encode($this->simpleSql($sql));
    }
    public function colophon(){
        return json_encode($this->simpleSql("select * from citazioni order by random();"));
    }
    public function authBook($id){
        $sql = "select l.id, l.titolo from libri l, authbook a where a.libro = l.id and a.autore = ".$id." order by 2 asc;";
        return json_encode($this->simpleSql($sql));
    }
}

?>
