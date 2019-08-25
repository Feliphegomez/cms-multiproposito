<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * Git: https://github.com/Feliphegomez/crm-crud-api-php
 * *******************************
 */

class RequestStatus extends EntidadBase {
	public $adapter;
    
    public function __construct($adapter) {
		$this->adapter = $adapter;
        $table = TBL_REQUEST_STATUS;
        parent::__construct($table, $adapter);
    }
	
	
	public function getById($id){
		$id = (isset($id) && $id > 0) ? $id : 0;
		$items = parent::getById($id);
		if(isset($items[0])){
			foreach($items[0] as $k=>$v){
				$this->{$k} = $v;
			}
		}
	}
	
}
