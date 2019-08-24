<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * Git: https://github.com/Feliphegomez/crm-crud-api-php
 * *******************************
 */

class Nodo extends EntidadBase {
	public $adapter;
    
    public function __construct($adapter) {
		$this->adapter = $adapter;
        $table = TBL_NODES;
        parent::__construct($table, $adapter);
    }
	
	public function current(){
		$urlCompleta = ((@intval($_SERVER['HTTP_X_FORWARDED_PORT']) ?: @intval($_SERVER["SERVER_PORT"]) ?: (($this->protocol === 'https') ? 443 : 80) === 443) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$urlSimple = $_SERVER['REQUEST_URI'];
		$items = parent::getBy('path_url', $urlSimple);
		if(isset($items[0])){
			$this->setAllData($items[0]);
		}else{
			$this->principal();
		}
	}
	
	public function principal(){
		$option = new Option($this->adapter);
		$option->getBySlug('principal_page');
		$id = (isset($option->node) && $option->node > 0) ? $option->node : 0;
		$this->getById($id);
	}
	
	public function getById($id){
		$id = (isset($id) && $id > 0) ? $id : 0;
		$items = parent::getById($id);
		if(isset($items[0])){
			$this->setAllData($items[0]);
		}
	}
	
	public function setAllData($item){
		foreach($item as $k=>$v){
			$this->{$k} = $v;
			if($k === 'type'){
				$this->type = new NodeType($this->adapter);
				$this->type->getById($v);
			}
		}
	}
	
	public function getBy($column, $value){
		$items = parent::getBy($column, $value);
		if(isset($items[0])){
			$this->setAllData($items[0]);
		}
	}
}

/* *******************************
 *
 * Developer by FelipheGomez
 *
 * Git: https://github.com/Feliphegomez/crm-crud-api-php
 * *******************************
 */

class NodeType extends EntidadBase {
    public function __construct($adapter) {
		$table = TBL_TYPES_NODES;
		parent::__construct($table, $adapter);
    }
	
	public function getById($id){
		$id = (isset($id) && $id > 0) ? $id : 0;
		$items = parent::getById($id);
		if(isset($items[0])){
			$this->setAllData($items[0]);
		}
	}
}