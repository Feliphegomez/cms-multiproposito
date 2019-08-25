<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * Git: https://github.com/Feliphegomez/crm-crud-api-php
 * *******************************
 */

class Request extends EntidadBase {
	public $adapter;
    
    public function __construct($adapter) {
		$this->adapter = $adapter;
        $table = TBL_REQUESTS;
        parent::__construct($table, $adapter);
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
			if($k == 'status'){
				$this->status = new RequestStatus($this->adapter);
				$this->status->getById($v);
			}
		}
	}
	
}
