<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * Git: https://github.com/Feliphegomez/crm-crud-api-php
 * *******************************
 */

class Node extends EntidadBase {
    public function __construct() {
		$table = TBL_NODES;
        parent::__construct($table);
    }
	
	public function principal(){
		$option = new Option();
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
		parent::setAllData($item);
		foreach($item as $k=>$v){
			if($k === 'type'){
				$this->type = new NodeType();
				$this->type->getById($v);
			}
		}
	}
}