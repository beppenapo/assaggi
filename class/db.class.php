<?php
/**
 *
 */
require("conn.class.php");
class Db extends Conn{
    private $string = PDO::PARAM_STR;
    private $integer = PDO::PARAM_INT;

    public function simpleSql($sql){
        $pdo = $this->pdo();
        $exec = $pdo->prepare($sql);
        try {
            $exec->execute();
            return $exec->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return  "errore: ".$e->getMessage();
        }
    }
    public function preparedSql($action, $sql, $dati=array()){
        if(!is_array($dati)){return "i dati devono essere un array";}
        $pdo = $this->pdo();
        $exec = $pdo->prepare($sql);
        try {
            $exec->execute($dati);
            if($action == "nuovo"){ $out = "Ok, il nuovo record è stato creato"; }
            elseif ($action == "modifica") { $out = "Ok, il record è stato modificato"; }
            else{ $out == "Ok, il record è stato definitivamente eliminato"; }
            return $out;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

?>
