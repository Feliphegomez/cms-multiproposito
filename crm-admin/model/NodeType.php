<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * Git: https://github.com/Feliphegomez/crm-crud-api-php
 * *******************************
 */

class NodeType extends EntidadBase {
    public $id, $name, $template, $system;
     
    public function __construct() {
		$table = TBL_TYPES_NODES;
        parent::__construct($table);
    }
	
	public function __toString(){
		return $this->name;
	}
	
	public function getById($id){
		$id = (isset($id) && $id > 0) ? $id : 0;
		$node = parent::getById($id);
		if(isset($items[0])){
			foreach($items[0] as $k=>$v){
				$this->{$k} = $v;
			}
		}
	}
}