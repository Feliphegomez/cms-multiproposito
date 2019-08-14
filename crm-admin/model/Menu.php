<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * Git: https://github.com/Feliphegomez/crm-crud-api-php
 * *******************************
 */

class Menu extends EntidadBase {
	public $childs;
	
    public function __construct() {
		$this->childs = array();
        $table = TBL_MENUS;
        parent::__construct($table);
    }
	
	public function getBy($column, $value){
		$items = parent::getSQL("SELECT m.*, (SELECT COUNT(*) FROM " . TBL_MENUS_ITEMS . " WHERE menu=m.id) AS total_childs FROM " . TBL_MENUS . " AS m WHERE {$column}=?", array($value));
		if(isset($items[0])){ $this->setAllData($items[0]); };
	}
	
	
	public function getById($id){
		$id = (isset($id) && $id > 0) ? $id : 0;
		$items = parent::getSQL("SELECT m.*, (SELECT COUNT(*) FROM {$this->getTabla()} WHERE menu=m.id) AS total_childs FROM menus AS m WHERE id=?", array($id));
		if(isset($items[0])){ $this->setAllData($items[0]); };
		
	}
	
	public function getBySlug($slug){
		$slug = (isset($slug) && $slug > 0) ? $slug : 0;
		$items = parent::getBySlug($slug);
		if(isset($items[0])){ $this->setAllData($items[0]); };
	}
	
	public function setAllData($item){
		parent::setAllData($item);
		foreach($item as $k=>$v){
			/*
			if ($k === 'permissions'){
				$this->permissions = new Permiso();
				$this->permissions->getById($v);
			}
			*/
		}
	}
 
}