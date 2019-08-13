<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * Git: https://github.com/Feliphegomez/crm-crud-api-php
 * *******************************
 */
require_once(folder_admin . '/config/database.php');

class Conectar {
    private $driver;
    private $host, $user, $pass, $database, $charset;
   
    public function __construct() {
        $this->driver = DB_driver;
        $this->host = DB_host;
        $this->user = DB_user;
        $this->pass = DB_pass;
        $this->database = DB_database;
        $this->charset = DB_charset;
    }
     
    public function conexion(){
        if($this->driver=="mysql" || $this->driver==null){
            $con=new mysqli($this->host, $this->user, $this->pass, $this->database);
            $con->query("SET NAMES '".$this->charset."'");
        }
        return $con;
    }
     
     
    public function conexionPDO(){
		try {
			if($this->driver=="mysql" || $this->driver==null){
				# $con=new mysqli($this->host, $this->user, $this->pass, $this->database);
				$pdo = new PDO(
					$this->driver.":host={$this->host};dbname={$this->database}",
					"{$this->user}",
					"{$this->pass}",
					array(
						PDO:: ATTR_PERSISTENT => true,
						PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES ".$this->charset
					));
				# $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				# $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				// PDO:: ATTR_PERSISTENT
			}
			return $pdo;
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}

    }
     
    public function startFluent(){
        require_once "FluentPDO/FluentPDO.php";
         
        if($this->driver=="mysql" || $this->driver==null){
            $pdo = new PDO($this->driver.":dbname=".$this->database, $this->user, $this->pass);
            $fpdo = new FluentPDO($pdo);
        }
         
        return $fpdo;
    }

}
?>
