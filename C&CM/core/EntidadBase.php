<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class EntidadBase{
    private $table;
    private $db;
    private $conectar;
    private $columnas;
    private $fields;
 
    public function __construct($table, $adapter) {
        $this->table = (string) $table;
        $this->conectar = null;
        $this->db = $adapter;
		$this->columnas = $this->cargarMisColumnas();
		$this->defineThis();
    }
	
	public function getTable(){
		return isset($this->table) ? $this->table : '';
	}
	
    public function _toString() {
        return json_encode($this);
    }
	
    public function __sleep() {
        return $this->fields;
    }
	
    public function set($key, $value){
        $this->{$key} = $value;;
    }
	
	public function defineThis(){
		$this->fields = array();
		foreach($this->getColumns() as $column){
			$c1 = true;
			if(
				$column->columna_extra == "on update CURRENT_TIMESTAMP" 
				|| $column->columna_value_default == "CURRENT_TIMESTAMP"
			){
				$c1 = false;
			}
			if($c1 == true){
				if (isset($column->nullValido) && $column->nullValido == 'YES'){
					$value = null;
				}
				
				if ($column->data_tipo === 'timestamp'){
					$value = date('Y-m-d G:i:s');
				} 
				else if ($column->data_tipo === 'datetime'){
					$value = date("Y-m-d H:i:s", time());
				} 
				else if ($column->data_tipo === 'datetime'){
					$value = date("Y-m-d", time());
				} 
				else if ($column->data_tipo === 'time'){
					$value = date("H:i:s", time());
				} 
				else if ($column->data_tipo === 'json'){
					$value = (json_decode($value) == null) ? json_decode("{}") : json_decode($value);
				} 
				else if ($column->data_tipo === 'varchar' || $column->data_tipo === 'text'){
					$value = "";
				} 
				else {
					$value = $column->columna_value_default;
				}
				$value = ($value == null && isset($column->nullValido) && $column->nullValido == 'NO') ? "" : $value;
				if ($column->columna_extra == "auto_increment"){ $value = null; } 
				
				$this->fields[] = $column->columna_nombre;
				$this->{$column->columna_nombre} = $value;
			}
			
		}
	}
	
	public function getColumns(){
		return $this->columnas;
	}
	
	public function cargarMisColumnas(){
		#$base_de_datos = new Conectar();
		#$base_de_datos = $this->conectar->conexionPDO();
		$sql = "SELECT 
				COLUMN_NAME AS columna_nombre,
				ORDINAL_POSITION AS posicion_original,
				COLUMN_DEFAULT AS columna_value_default,
				IS_NULLABLE AS nullValido,
				DATA_TYPE AS data_tipo,
				CHARACTER_MAXIMUM_LENGTH AS length_max,
				COLUMN_TYPE AS columna_tipo,
				COLUMN_KEY AS columna_key,
				EXTRA AS columna_extra,
				COLUMN_COMMENT AS columna_comnetario 
			FROM information_schema.columns 
			WHERE table_schema = '" . DB_database . "' AND table_name = '$this->table'
			";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_OBJ);
	}
     
    public function getConetar(){
        return $this->conectar;
    }
     
    public function db(){
        return $this->db;
    }
     
    public function getAllUser($user_id=0){
        $query=$this->db->query("SELECT * FROM users_{$this->table} WHERE user IN ({$user_id}) ORDER BY id DESC");
        return $this->FetchObject($query);
    }     
     
    public function getAll(){
        $query=$this->db->query("SELECT * FROM $this->table ORDER BY id DESC");
        return $this->FetchObject($query);
    }
     
	public function FetchObject($query){
		try {
			$result = (!isset($query) || $query == false) ? array() : $query->fetchAll(PDO::FETCH_OBJ);
			return $result;
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
			return [];
		}
	}
	
    public function getById($id){
        $query=$this->db->query("SELECT * FROM $this->table WHERE id=$id");
        return $this->FetchObject($query);
    }
     
    public function getBy($column,$value){
        $query = $this->db->query("SELECT * FROM $this->table WHERE $column='$value'");
        return $this->FetchObject($query);
    }
     
    public function deleteById($id){
        $query=$this->db->query("DELETE FROM $this->table WHERE id=$id");
        return $query;
    }
     
    public function deleteBy($column,$value){
        $query=$this->db->query("DELETE FROM $this->table WHERE $column='$value'");
        return $query;
    }
 
    /*
     * Aquí podemos montarnos un montón de métodos que nos ayuden
     * a hacer operaciones con la base de datos de la entidad
     */
	public function getId(){
		return $this->id;
	}
	
	public function isValid(){
		if($this->getId() > 0){ return true; } else { return false; }
	}
	
	public function setAllData($item){
		foreach($item as $k=>$v){
			$this->{$k} = $v;
		}
	}
	
    public function getSQL($sql="", $params=null){
		#return $this->FetchObject($query);
		try {
			$query = $this->db->prepare($sql);
			$query->execute($params);
			
			$result = $query->fetchAll(PDO::FETCH_OBJ);
			#$this->db = null;
			$query = null;
			
			return $result;
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>" . $sql . "<br/>";
			die();
		}
    }
	
    public function save(){
		if(isset($this->id) && $this->id > 0){
			#UPDATE
		}else{
		}
    }
 

}
