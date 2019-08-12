<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * Git: https://github.com/Feliphegomez/crm-crud-api-php
 * *******************************
 */

class NodeType extends EntidadBase {
    public function __construct() {
		$table = TBL_TYPES_NODES;
        parent::__construct($table);
    }
	
	public function getById($id){
		$id = (isset($id) && $id > 0) ? $id : 0;
		$items = parent::getById($id);
		if(isset($items[0])){
			$this->setAllData($items[0]);
		}
	}
}