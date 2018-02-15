<?php
//session_start();
require("../class/book.class.php");
$obj = new Book;
if(isset($_POST['func']) && function_exists($_POST['func'])) {
    $funzione = $_POST['func'];
    $trigger = $funzione($obj);
    echo $trigger;
}
function scheda($obj){ return $obj->scheda($_POST['book']); }
?>
