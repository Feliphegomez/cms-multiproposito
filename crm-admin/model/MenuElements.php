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
		$table = TBL_MENUS_ITEMS;
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
     
    public function getAllBy($column, $value){
		$items = parent::getAllBy($column, $value);
		$r = array();
		$sessionActive = ControladorBase::isUser();
		#echo json_encode($items)."<hr>";
		#exit();
		foreach($items as $child) {
			if ($sessionActive == true && ControladorBase::validatePermission($child->permision_controller, $child->permission_action) == true){
				$r[] = $child;
			}else if($child->public == 1 && $child->guest == 1 && $sessionActive == false) {
				if($sessionActive == false){ $r[] = $child; }
			} 
			else if($child->public == 1 && $child->guest == 0 && $sessionActive == true) {
				$r[] = $child;
			} else if($child->public == 0 && $child->guest == 0) {
				if (ControladorBase::validatePermission($child->permision_controller, $child->permission_action) == true) { $r[] = $child; }
			}else{
				if (ControladorBase::validatePermission("isAdmin", "global") == true){
					
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