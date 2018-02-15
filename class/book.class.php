<?php
session_start();
require("db.class.php");
class Book extends Db{
    function __construct(){}

    public function scheda($book){
        $sql = "select l.id,l.copertina,l.titolo,l.isbn,l.editore,l.anno,l.pagine,l.tag,l.descrizione , c.categoria,json_agg(trim(coalesce(a.nome,'')||' '||a.cognome)) as autore, l.incipit from libri l, authbook ab, autori a, liste.categorie c where l.id = ".$book." and ab.libro = l.id and ab.autore = a.id and l.genere = c.id group by l.id,c.categoria;";
        return json_encode($this->simpleSql($sql));
    }
}

?>
