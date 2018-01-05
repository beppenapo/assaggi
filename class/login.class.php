<?php
/**
 *
 */
require("conn.class.php");
class Login{
    private $usr='';
    private $pwd='';
    private $dbConn;
    public $msg;
    function __construct($usr, $pwd){
        $this->usr = $usr;
        $this->pwd = $pwd;
        $this->msg='';
        $this->dbConn = new Conn;
        $this->login();
    }

    private function login(){
        $sql = "select u.id, r.id as rubrica, r.utente, r.tipo, r.email,u.attivo, u.pwd, u.salt, u.img from main.usr u, main.rubrica r where u.rubrica = r.id and u.attivo = 1 and r.email ='".$this->usr."'";
        $row = $this->countRow($sql);
        if ($row>0) {
            $this->checkPwd($sql);
        }else{
            $this->msg = "errore, la mail inserita non è presente nel database o non è scritta correttamente!";
        }
    }

    private function countRow($sql){
        $pdo = $this->dbConn->pdo();
        try {
            $row = $pdo->query($sql)->rowCount();
            return $row;
        } catch (Exception $e) {
            $this->msg =  "errore: ".$e->getMessage();
        }
    }
    private function checkPwd($sql){
        $pdo = $this->dbConn->pdo();
        $exec = $pdo->prepare($sql);
        try {
            $exec->execute();
            $utente = $exec->fetchAll(PDO::FETCH_ASSOC);
            $pwd =hash('sha512',$this->pwd . $utente[0]['salt']);
            if ($pwd === $utente[0]['pwd']) {
                $this->setSession($utente);
            }else{
                $this->msg= 'errore, la password non è corretta!';
            }
        } catch (Exception $e) {
            $this->msg =  "errore: ".$e->getMessage();
        }
    }

    private function setSession($utente){
        $username = $this->getUsername($utente[0]['email']);
        $_SESSION['username']=$username;
        $_SESSION['id']=$utente[0]['id'];
        $_SESSION['classe']=$utente[0]['classe'];
        $_SESSION['email']=$utente[0]['email'];
        $_SESSION['salt']=$utente[0]['salt'];
    }

    private function getUsername($email){
        $u = explode("@",$email);
        return $u[0];
    }

    private function getIp(){
        if (isset($_SERVER)){
            if(isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
                $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
                if(strpos($ip,",")){
                    $exp_ip = explode(",",$ip);
                    $ip = $exp_ip[0];
                }
            }else if(isset($_SERVER["HTTP_CLIENT_IP"])){
                $ip = $_SERVER["HTTP_CLIENT_IP"];
            }else{
                $ip = $_SERVER["REMOTE_ADDR"];
            }
        }else{
            if(getenv('HTTP_X_FORWARDED_FOR')){
                $ip = getenv('HTTP_X_FORWARDED_FOR');
                if(strpos($ip,",")){
                    $exp_ip=explode(",",$ip);
                    $ip = $exp_ip[0];
                }
            }else if(getenv('HTTP_CLIENT_IP')){
                $ip = getenv('HTTP_CLIENT_IP');
            }else {
                $ip = getenv('REMOTE_ADDR');
            }
        }
        return $ip;
    }
}
?>
