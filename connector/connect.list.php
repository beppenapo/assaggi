<?php
session_start();
require("../class/list.class.php");
$obj = new Lista($_POST['func']);
echo $obj->out;
// if(isset($_POST['func'])) {
//     $funzione = $_POST['func'];
//     $trigger = $obj->$funzione();
//     echo $trigger;
// }

// function titolo($obj){
//
// }
// function autore($obj){
//
// }
// function immagini($obj){
//
// }
?>
