<?php
//session_start();
require("../class/list.class.php");
$obj = new Lista;
if(isset($_POST['func']) && function_exists($_POST['func'])) {
    $funzione = $_POST['func'];
    $trigger = $funzione($obj);
    echo $trigger;
}
function lista($obj){ return $obj->lista($_POST['tag']); }
function filtroAutore($obj){ return $obj->filtroAutore(); }
function autori($obj){return $obj->autori();}
function img($obj){return $obj->img();}
function colophon($obj){return $obj->colophon();}
function authBook($obj){return $obj->authBook($_POST['id']);}
function tagList($obj){return $obj->tagList();}
// $obj = new Lista($_POST['func'],$dati = array($auth => 165));
// echo $obj->out;
?>
