<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/
class Conectar{
    private $driver;
    private $host, $user, $pass, $database, $charset, $port;
   
    public function __construct() {
        $db_cfg = require_once folder_data . '/config/database.php';
        $this->driver = DB_driver;
        $this->host = DB_host;
        $this->user = DB_user;
        $this->pass = DB_pass;
        $this->database = DB_database;
        $this->charset = DB_charset;
        $this->port = DB_port;
    }
     
    public function conexion($pdo=true){
		if($pdo == true){
			return $this->conexionPDO();
		} else {
			 if($this->driver=="mysql" || $this->driver==null){
				$con=new mysqli($this->host, $this->user, $this->pass, $this->database);
				$con->query("SET NAMES '".$this->charset."'");
				$con->query("SET SESSION sql_warnings=1;");
				$con->query("SET SESSION sql_mode = \"ANSI,TRADITIONAL\";");
			}
			return $con;
		}
		
       
         
    }
	
    public function conexionPDO(){
		try {
			if($this->driver=="mysql" || $this->driver==null){
				# $con=new mysqli($this->host, $this->user, $this->pass, $this->database);
				$pdo = new PDO(
					$this->driver.":host={$this->host};dbname={$this->database}",
					"{$this->user}",
					"{$this->pass}",
					array
						(
							# PDO:: ATTR_PERSISTENT => true,
							PDO::MYSQL_ATTR_INIT_COMMAND
							=> 
							"SET lc_time_names='es_CO',NAMES '{$this->charset}'"
						)
					);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			}
			return $pdo;
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}

    }
     
    public function startFluent(){
        require_once "libs/FluentPDO/FluentPDO.php";
         
        if($this->driver=="mysql" || $this->driver==null){
            $pdo = new PDO($this->driver.":dbname=".$this->database, $this->user, $this->pass,
					array(
						PDO::MYSQL_ATTR_INIT_COMMAND
							=> 
							"SET lc_time_names='es_CO',NAMES '{$this->charset}'"
					));
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $fpdo = new FluentPDO($pdo);
        }
         
        return $fpdo;
    }
}
