<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * Git: https://github.com/Feliphegomez/crm-crud-api-php
 * *******************************
 */

class Permiso extends EntidadBase {
	public $adapter;
	
    public function __construct($adapter=null) {
		if($adapter == null){
			#$conectar = new Conectar();
			#$adapter = $conectar->conexion();
		}
		$this->adapter = $adapter;
        $table = TBL_PERMISSIONS;
        parent::__construct($table, $adapter);
    }
	
    public function setId($id) {
        $this->id = $id;
    }
     
    public function getNombre() {
        return $this->name;
    }
 
    public function setNombre($name) {
        $this->name = $name;
    }
 
    public function getData() {
        return $this->data;
    }
 
    public function setData($data) { 
        $this->data = $data;
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
	
	public function getById($id){
		$id = (isset($id) && $id > 0) ? $id : 0;
		$items = parent::getById($id);
		if(isset($items[0])){
			$this->setAllData($items[0]);
		}
	}
	
	public function setAllData($item){
		parent::setAllData($item);
		foreach($item as $k=>$v){
			if($k === 'data'){
				$this->data = json_decode($v);
			}
		}
	}
}