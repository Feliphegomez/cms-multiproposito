<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * Git: https://github.com/Feliphegomez/crm-crud-api-php
 * *******************************
 */

class MenuElements extends EntidadBase {
	public $adapter;
    public function __construct($adapter) {
		$this->adapter = $adapter;
		$table = TBL_MENUS_ITEMS;
        parent::__construct($table, $adapter);
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
     
    public function getBy($column, $value){
		$items = parent::getBy($column, $value);
		$r = array();
		$sessionActive = isUser();
		#echo json_encode($items)."<hr>";
		#exit();
		foreach($items as $child) {
			if ($sessionActive == true && validatePermission($this->adapter, $child->permision_controller, $child->permission_action) == true){
				$r[] = $child;
			}else if($child->public == 1 && $child->guest == 1 && $sessionActive == false) {
				if($sessionActive == false){ $r[] = $child; }
			} 
			else if($child->public == 1 && $child->guest == 0 && $sessionActive == true) {
				$r[] = $child;
			} else if($child->public == 0 && $child->guest == 0) {
				if (validatePermission($this->adapter, $child->permision_controller, $child->permission_action) == true) { $r[] = $child; }
			} else if($child->alls == 1) {
				$r[] = $child;
			} else{
				if (validatePermission($this->adapter, "isAdmin", "global") == true){
					
				}
			}
		}
		return $r;
    }
     
    public function getAllBy($column, $value){
		$items = parent::getBy($column, $value);
		$r = array();
		$sessionActive = isUser();
		foreach($items as $child) {
			if ($sessionActive == true && validatePermission($this->adapter, $child->permision_controller, $child->permission_action) == true){
				$r[] = $child;
			}else if($child->public == 1 && $child->guest == 1 && $sessionActive == false) {
				if($sessionActive == false){ $r[] = $child; }
			} 
			else if($child->public == 1 && $child->guest == 0 && $sessionActive == true) {
				$r[] = $child;
			} else if($child->public == 0 && $child->guest == 0) {
				if (validatePermission($this->adapter, $child->permision_controller, $child->permission_action) == true) { $r[] = $child; }
			} else if($child->alls == 1) {
				$r[] = $child;
			} else {
				if (validatePermission($this->adapter, "isAdmin", "global") == true){
					
				}
			}
		}
		return $r;
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