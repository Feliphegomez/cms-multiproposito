<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * Git: https://github.com/Feliphegomez/crm-crud-api-php
 * *******************************
 */


class EntidadBase {
    private $table;
    private $db;
    private $conectar;
 
    public function __construct($table) {
		require_once 'Conectar.php';
        $this->table=(string) $table;
        $this->conectar=new Conectar();
        $this->db = $this->conectar->conexionPDO();
    }
     
    public function getConetar(){
        return $this->conectar;
    }
     
    public function db(){
        return $this->db;
    }
     
    public function getAll(){
		try {
			$query = $this->db->prepare("SELECT * FROM $this->table ORDER BY id DESC");
			//Devolvemos el resultset en forma de array de objetos
			while ($row = $query->fetch_object()) {
			   $resultSet[]=$row;
			}
			 
			 if(isset($resultSet)){
				 return $resultSet;
			 }else{
				 return array();
			 }
		}
		catch(Exception $e){
			echo 'Excepción capturada: ',  $e->getMessage(), "\n";
			echo json_encode($e);
			exit();
		}
    }
     
    public function getById($id){
		$sql = "SELECT * FROM {$this->table} WHERE id=?";
		$query = $this->db->prepare($sql);
		$query->execute([$id]);
		return $this->FetchObject($query);
    }
     
    public function getBy($column, $value){
		$sql = "SELECT * FROM {$this->table} WHERE {$column}=?";
		$query = $this->db->prepare($sql);
		$query->execute([$value]);
		return $this->FetchObject($query);
    }
     
    public function deleteById($id){
        #$query = $this->db->prepare("DELETE FROM $this->table WHERE id=$id");
        #return $this->FetchObject($query);
    }
     
    public function deleteBy($column,$value){
       #$query = $this->db->prepare("DELETE FROM $this->table WHERE $column='$value'");
       #return $this->FetchObject($query);
    }
     
    public function get($key) { return $this->{$key}; }
 
    public function set($key, $id) { $this->{$key} = $id; }
 
    /*
     * Aquí podemos montarnos un montón de métodos que nos ayuden
     * a hacer operaciones con la base de datos de la entidad
     */
    public function getByDoubleColm($k1, $v1, $k2, $v2){
		$r = null;
        #$query = $this->db->query("SELECT * FROM $this->table WHERE {$k1} IN ('{$v1}') AND {$k2} IN ('{$v2}')");
		#return $this->FetchObject($query);		 
    }
	
	public function FetchObject($query){
		$result = $query->fetchAll();
		return $result;
	}
	
	public function getId(){
		return ($this->get('id') == null) ? 0 : (int) $this->id;
	}
	
	public function isValid(){
		if($this->getId() > 0){ return true; } else { return false; }
	}
	
	public function __EntidadToString(){
		return json_encode($this);
	}
	
	public function setAllData($item){
		foreach($item as $k=>$v){
			$this->{$k} = $v;
		}
	}
}
