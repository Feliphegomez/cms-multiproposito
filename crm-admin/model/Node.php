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
	
	public function current(){
		if (isset($this->id) && $this->id > 0){
			$this->getById($id);
			$this->createLog('NodeView');
		}else{
			$urlCompleta = ((@intval($_SERVER['HTTP_X_FORWARDED_PORT']) ?: @intval($_SERVER["SERVER_PORT"]) ?: (($this->protocol === 'https') ? 443 : 80) === 443) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			$urlSimple = $_SERVER['REQUEST_URI'];
			$items = $this->getBy('path_url', $urlSimple);
			if(isset($items[0])){
				$this->setAllData($items[0]);
			}
			
			if(!$this->isValid()){
				$this->principal();
			}else{
				$this->createLog('NodeCurrentView');
			}
		}
	}
	
	public function principal(){
		$option = new Option();
		$option->getBySlug('principal_page');
		$id = (isset($option->node) && $option->node > 0) ? $option->node : 0;
		$this->getById($id);
		$this->createLog('NodeHomeView');
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
			if($k === 'type'){
				$this->type = new NodeType();
				$this->type->getById($v);
			}
		}
	}
	
}