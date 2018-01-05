<?php
require_once("../class/db.class.php");
$conn = new Db;
$out=array();
$sqlBook = "select id, titolo from libri order by inserimento desc limit 5;";
$sqlAuthor = "select id, cognome||' '||nome as autore from autori order by random() limit 5;";
$sqlCover = "select id, copertina from libri where copertina is not null order by random() limit 10;";
$sqlTag = "select * from liste.tag order by tag asc;";

$book = $conn->simpleSql($sqlBook);
$author = $conn->simpleSql($sqlAuthor);
$cover = $conn->simpleSql($sqlCover);
$tag = $conn->simpleSql($sqlTag);

array_push($out,$book);
array_push($out,$author);
array_push($out,$cover);
array_push($out,$tag);
echo json_encode($out);

?>
