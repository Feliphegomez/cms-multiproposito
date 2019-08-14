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
    private $columnas;
    private $fields;
 
    public function __construct($table) {
        $this->table = (string) $table;
        $this->conectar = new Conectar();
        $this->db = $this->conectar->conexionPDO();
		$this->columnas = $this->cargarMisColumnas();
		$this->defineThis();
    }
	
    public function _toString() {
        return json_encode($this);
    }
	
    public function __sleep() {
        return $this->fields;
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
				else if ($column->data_tipo === 'varchar' || $column->data_tipo === 'mediumblob' || $column->data_tipo === 'text'){
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
	
    public function getTabla(){
        return $this->table;
    }
     
    public function db(){
        return $this->db;
    }
     
    public function getAllBy($column, $value){
		$sql = "SELECT * FROM {$this->table} WHERE {$column}=?";
		$query = $this->db->prepare($sql);
		$query->execute([$value]);
		return $this->FetchList($query);
    }
     
    public function getAll(){
		try {
			$sql = "SELECT * FROM {$this->table} ";
			$query = $this->db->prepare($sql);
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_OBJ);
			$query = null;
			return $result;
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
    }
     
    public function getById($id){
		$sql = "SELECT * FROM {$this->table} WHERE id=?";
		$query = $this->db->prepare($sql);
		$query->execute([$id]);
		
		return $this->FetchObject($query);
    }
	
	public function createLog($action='None'){
		if(isset($_SESSION['user']['id'])){
			$log = new Logs();
			$log->user = $_SESSION['user']['id'];
			$log->action = $action;
			$log->tableDB = $this->getTabla();
			$log->data = json_encode(json_decode(@json_encode($this)));
			$log->url = ((@intval($_SERVER['HTTP_X_FORWARDED_PORT']) ?: @intval($_SERVER["SERVER_PORT"]) ?: (($this->protocol === 'https') ? 443 : 80) === 443) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			$log->create();
		}
	}
     
    public function getBy($column, $value){
		$sql = "SELECT * FROM {$this->table} WHERE {$column}=?";
		$query = $this->db->prepare($sql);
		$query->execute([$value]);
		return $this->FetchObject($query);
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
	
	public function FetchList($query){
		try {
			$result = $query->fetchAll(PDO::FETCH_OBJ);
			#$this->db = null;
			$query = null;
			
			return $result;
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}
	
	public function FetchObject($query){
		try {
			$result = $query->fetchAll(PDO::FETCH_OBJ);
			#$this->db = null;
			$query = null;
			
			return $result;
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
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
	
	public function getColumn($field_name=null){
		$r = null;
		foreach($this->getColumns() as $column){
			if($column->columna_nombre == $field_name){
				return $column;
			}
		}
		return $r;
	}
	
	public function createFieldsForm($fields=null, $hidden_nullEnables=false, $enable_id=true){		
		##$fields = (!isset($fields) || !is_array($fields) || $fields == null) ? $this->__sleep() : $fields;
		$fields = (!isset($fields) || !is_array($fields) || $fields == null) ? $this->__sleep() : $fields;
		$r = array();
		foreach($fields as $field_name){
			$column = ($this->getColumn($field_name));
			$value = $this->{$field_name};
			$column->visible = (isset($column->visible)) ? $column->visible : true;
			
			$input = new stdClass();
			$input->show = $column->visible;
			$input->label = (isset($column->columna_comnetario) && $column->columna_comnetario != "") ? $column->columna_comnetario : $column->columna_nombre;
			$input->name = $column->columna_nombre;
			$input->value = (strpos($column->columna_extra, 'auto_incrementon') !== true) ? $value : null;
			$input->typeInput = ($column->visible === true) ? $column->data_tipo : 'hidden';
			$input->required = ($column->nullValido == 'YES') ? false : true;
			$input->_required = ($column->nullValido == 'YES') ? false : true;
			$input->innerHtml = $this->createInputForm($input);
			
			
			if ($column->columna_nombre === 'id' && $enable_id == true){ $continue = true; } 
			else if ($column->columna_nombre !== 'id'){ $continue = true; } 
			else { $continue = false; }
			
			if ($continue == true){
				if ($hidden_nullEnables === false){ $r[] = $input; } 
				else { if ($input->_required === true){ $r[] = $input; } }
			}
		}
		
		return $r;
	}
	
	public function createInputForm($input=null){
		$h = '';
		if($input != null){
			$input->className = (isset($input->className)) ? $input->className : 'form-control';
			$input->typeInput = (isset($input->typeInput)) ? $input->typeInput : 'text';
			$input->typeInput = ($input->typeInput === 'varchar') ? 'text' : $input->typeInput;
			$input->typeInput = ($input->typeInput === 'text') ? 'text' : $input->typeInput;
			$input->typeInput = ($input->typeInput === 'int') ? 'number' : $input->typeInput;
			$input->typeInput = ($input->name === 'password' && $input->typeInput === 'text') ? 'password' : $input->typeInput;
			$input->typeInput = ($input->name === 'email' && $input->typeInput === 'text') ? 'email' : $input->typeInput;
			$input->value = (isset($this->{$input->name}) && $this->{$input->name} !== null) ? $this->{$input->name} : $input->value;
			
			$input->required = ($input->required === true) ? " required=\"{$input->required}\"" : "";
			switch($input->typeInput){
				case 'text':
					$h .= "<input name=\"{$input->name}\" 
						placeholder=\"{$input->label}\" 
						value=\"{$input->value}\" 
						type=\"{$input->typeInput}\" 
						class=\"{$input->className}\" {$input->required} />";
				break;
				case 'textarea':
					$h .= "<textarea name=\"{$input->name}\" 
						placeholder=\"{$input->label}\" 
						class=\"{$input->className}\" {$input->required}\">{$input->value}</textarea>";
				break;
				default:
					$h .= "<input name=\"{$input->name}\" 
						placeholder=\"{$input->label}\" 
						value=\"{$input->value}\" 
						type=\"{$input->typeInput}\" 
						class=\"{$input->className}\" {$input->required}
						 />";
				break;
			}
			/*
			$h .= "<div class=\"form-group\">";
				$h .= "<label class=\"control-label col-md-4 col-sm-4 col-xs-12\" for=\"first-name\">";
					$h .= "{$input->label} ";
					$h .= "<span class=\"required\">*</span>";
				$h .= "</label>";
				$h .= "<div class=\"col-md-8 col-sm-8 col-xs-12\">";			
					
				$h .= "</div>";
			$h .= "</div>";*/
		}
		return $h;
	}
	
    public function create(){
		$resultado = new stdClass();
		$resultado->error = true;
		$resultado->id = 0;
		$resultado->errorInfo = null;
		$resultado->errorObject = null;
		$resultado->data = [];
		
		$keys = array();
		$keysv = array();
		$data = array();
		foreach($this->fields as $k){
			if(isset($this->{$k})){
				$keysv[] = ":{$k}";
				$keys[] = $k;
					$resultado->data[$k] = $this->{$k};
			}
		}
		
		$keysText = implode(',', $keys);
		$keysValues = implode(',', $keysv);
		$sql = "INSERT INTO $this->table ($keysText) VALUES ($keysValues)";
		$query = $this->db->prepare($sql);
		
		
		#echo json_encode($sql)."<hr>\n";
		#echo json_encode($keysText)."<hr>\n";
		#echo json_encode($keysValues)."<hr>\n";
		#exit();
		try {
			$resultado->error = $query->execute($resultado->data);
			// $resultado->id = $query->lastInsertId(); 
			$resultado->id = $this->db->lastInsertId();
			$resultado->error = ($resultado->id > 0) ? false : true;
			
		}
		catch (Exception $e){
			$infoError = ($query->errorInfo());
			switch($infoError[1]){
				case '1062':
					#$resultado->errorInfo = "Esto, ya existe en la base de datos, intenta cambiando algunos datos.";
					$resultado->errorInfo = preg_replace_callback("/^Duplicate entry '(.*)' for key '(.*)'$/", function ($m) {
					   return sprintf("%s ya existe.", $m[1]);
					}, $infoError[2]);
				break;
				default:
					$resultado->errorInfo = ($e->errorInfo());
				break;
			}
			$resultado->errorObject = $e;
		}
		return $resultado;
		/*
			OK:
				{"error":false,"errorInfo":null,"data":{...}}
			KO:
				{"error":true,"errorInfo":[infor error],"data":{...}}
		*/
    }
	
    public function save(){
		$resultado = new stdClass();
		$resultado->error = true;
		$resultado->id = 0;
		$resultado->errorInfo = null;
		$resultado->errorObject = null;
		$resultado->data = [];
		
		$keys = array();
		$keysv = array();
		$data = array();
		foreach($this->fields as $k){
			if(!is_object($this->{$k})){
				#if(($k) !== 'id' && ($k) !== 'created' && ($k) !== 'updated' &&	($k) !== 'password' &&	($k) !== 'registered'){
				if(($k) !== 'id' && ($k) !== 'created' && ($k) !== 'updated' &&	($k) !== 'password' &&	($k) !== 'registered'){
					$keysv[] = "{$k}=:{$k}";
					$keys[] = $k;
					$resultado->data[$k] = $this->{$k};
				} 
				else if ($k == 'id') {
					$resultado->data[$k] = $this->{$k};
				}
			}
		}
		
		$keysText = implode(',', $keys);
		$keysValues = implode(',', $keysv);
		$sql = "UPDATE $this->table SET $keysValues WHERE id=:id";
		$query = $this->db->prepare($sql);
		try {
			$resultado->error = $query->execute($resultado->data);
			// $resultado->id = $query->lastInsertId(); 
			$resultado->id = $this->db->lastInsertId();
			$resultado->error = ($resultado->id > 0) ? false : true;
			
		}
		catch (Exception $e){
			$infoError = ($query->errorInfo());
			switch($infoError[1]){
				case '1062':
					#$resultado->errorInfo = "Esto, ya existe en la base de datos, intenta cambiando algunos datos.";
					$resultado->errorInfo = preg_replace_callback("/^Duplicate entry '(.*)' for key '(.*)'$/", function ($m) {
					   return sprintf("%s ya existe.", $m[1]);
					}, $infoError[2]);
				break;
				default:
					$resultado->errorInfo = ($e->errorInfo());
				break;
			}
			$resultado->errorObject = $e;
		}
		return $resultado;
		/*
			OK:
				{"error":false,"errorInfo":null,"data":{...}}
			KO:
				{"error":true,"errorInfo":[infor error],"data":{...}}
		*/
    }
}
