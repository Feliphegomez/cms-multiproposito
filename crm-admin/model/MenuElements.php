<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * Git: https://github.com/Feliphegomez/crm-crud-api-php
 * *******************************
 */

class MenuElements extends EntidadBase {
    public function __construct() {
		$table = TBL_NODES_ITEMS;
        parent::__construct($table);
    }
	
	public function getById($id){
		$id = (isset($id) && $id > 0) ? $id : 0;
		$items = parent::getById($id);
		if(isset($items[0])){
			$this->setAllData($items[0]);
		}
		#if($id != 1){
			# $this->createLog('View');
		#}
	}
	
	public function setAllData($item){
		parent::setAllData($item);
		foreach($item as $k=>$v){
			/*if($k === 'type'){
				$this->type = new NodeType();
				$this->type->getById($v);
			}*/
		}
	}
	
}