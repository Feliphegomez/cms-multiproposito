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
		require_once 'Conectar.php';
        $this->table=(string) $table;
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
			$value = $column->columna_value_default;
			if($column->nullValido == 'NO' && $column->columna_value_default === null){
				$value = ($column->data_tipo);
			}
			switch($column->data_tipo){
				case "varchar":
					$value = (string) ($column->columna_value_default);
				break;
				case "text":
					$value = (string) ($column->columna_value_default);
				break;
				case "int":
					$value = (int) $column->columna_value_default;
				break;
				case "json":
					$value = (json_decode($value) == null) ? json_decode("{}") : json_decode($value);
				break;
				default:
					if($column->nullValido == 'YES'){
						$value = null;
					}else{
						$value = $column->data_tipo;
					}
				break;
			}
			
			$this->fields[] = $column->columna_nombre;
			$this->{$column->columna_nombre} = $value;
		}
	}
	
	public function getColumns(){
		return $this->columnas;
	}
	
	public function cargarMisColumnas(){
		$base_de_datos = new Conectar();
		$base_de_datos = $this->conectar->conexionPDO();
		
		return $base_de_datos->query(
			"SELECT 
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
			"
		)->fetchAll(PDO::FETCH_OBJ);
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
		$result = $query->fetchAll(PDO::FETCH_OBJ);
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
	
	public function createFieldsForm($fields=null, $hidden_nullEnables=false, $enable_id=true){
		$fields = (!isset($fields) || !is_array($fields) || $fields == null) ? $this->getColumns() : $fields;
		$r = array();
		foreach($fields as $column){
			$value = $column->columna_value_default;
			$column->visible = (isset($column->visible)) ? $column->visible : true;
			if($column->nullValido == 'NO' && $column->columna_value_default === null){
				$value = ($column->data_tipo);
			}
			switch($column->data_tipo){
				case "varchar":
					$value = (string) ($column->columna_value_default);
				break;
				case "text":
					$value = (string) ($column->columna_value_default);
				break;
				case "int":
					$value = (int) $column->columna_value_default;
				break;
				case "datetime":
					$value = date("Y-m-d H:i:s", time());
				break;
				case "date":
					$value = date("Y-m-d", time());
				break;
				case "time":
					$value = date("H:i:s", time());
				break;
				case "json":
					$value = json_encode($value);
				break;
				case "json":
					$value = json_encode("{}");
				break;
				default:
					$value = "";
				break;
			}
			
			$this->fields[] = $column->columna_nombre;
			$value = (isset($this->{$column->columna_nombre}) && $this->{$column->columna_nombre} != null && $this->{$column->columna_nombre} != $value) ? $this->{$column->columna_nombre} : $value;
			
			$input = new stdClass();
			$input->show = $column->visible;
			$input->label = (isset($column->columna_comnetario) && $column->columna_comnetario != "") ? $column->columna_comnetario : $column->columna_nombre;
			$input->name = $column->columna_nombre;
			$input->value = (strpos($column->columna_extra, 'auto_incrementon') !== true) ? $value : null;
			$input->typeInput = ($column->visible === true) ? $column->data_tipo : 'hidden';
			$input->required = ($column->nullValido == 'YES') ? false : true;
			$input->innerHtml = $this->createInputForm($input);
			
			
			if($column->columna_nombre == 'id' && $enable_id == true){
				$continue = true;
			}else if($column->columna_nombre !== 'id'){
				$continue = true;
			}else{
				$continue = false;
			}
			
			if($continue === true){
				if($hidden_nullEnables === false){
					$r[] = $input;
				}else{
					if($input->required === true){
						$r[] = $input;
					}
				}
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
			switch($input->typeInput){
				case 'text':
					$h .= "<input name=\"{$input->name}\" 
						placeholder=\"{$input->label}\" 
						value=\"{$input->value}\" 
						type=\"{$input->typeInput}\" 
						class=\"{$input->className}\" 
						required=\"{$input->required}\" />";
				break;
				case 'textarea':
					$h .= "<textarea name=\"{$input->name}\" 
						placeholder=\"{$input->label}\" 
						class=\"{$input->className}\" 
						required=\"{$input->required}\">{$input->value}</textarea>";
				break;
				default:
					$h .= "<input name=\"{$input->name}\" 
						placeholder=\"{$input->label}\" 
						value=\"{$input->value}\" 
						type=\"{$input->typeInput}\" 
						class=\"{$input->className}\" 
						required=\"{$input->required}\" />";
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
			if(isset($this->{$k}) && $this->{$k} != null){
				$keysv[] = ":{$k}";
				$keys[] = $k;
				$resultado->data[$k] = $this->{$k};
			}
		}
		
		$keysText = implode(',', $keys);
		$keysValues = implode(',', $keysv);
		$sql = "INSERT INTO $this->table ($keysText) VALUES ($keysValues)";
		try {
			$query = $this->db->prepare($sql);
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
					$resultado->errorInfo = ($query->errorInfo());
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
        $query="INSERT INTO " . TBL_PERMISSIONS . " (id,nombre,apellido,email,password)
                VALUES(NULL,
                       '".$this->name."',
                       '".$this->data."');";
        $save=$this->db()->query($query);
        //$this->db()->error;
        return $save;
    }
}
