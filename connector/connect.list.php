<?php
session_start();
require("../class/list.class.php");
$obj = new Lista($_POST['func']);
echo $obj->out;
?>
