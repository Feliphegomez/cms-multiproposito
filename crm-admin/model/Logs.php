<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * Git: https://github.com/Feliphegomez/crm-crud-api-php
 * *******************************
 */

class Logs extends EntidadBase {
    public function __construct() {
		$table = TBL_LOGS;
        parent::__construct($table);
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
				$this->user = new Usuario();
				$this->user->getById($v);
			}
		}
	}
	
	public function create(){
		parent::create();
		/*
		$data = (isset($this->data)) ? json_decode($this->data) : array();
		$i = 0;
		foreach($data as $k => $v){
			$i++;
		}
		if($i>0){
			parent::create();
		}
		*/
	}
}