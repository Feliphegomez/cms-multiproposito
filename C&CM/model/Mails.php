<?php
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class Emails extends EntidadBase {
	public $adapter;

    public function __construct($adapter) {
		$this->adapter = $adapter;
        $table = TBL_MAILS;
        parent::__construct($table, $adapter);
    }
	
	public function getById($id){
		$id = (isset($id) && $id > 0) ? $id : 0;
		$items = parent::getById($id);
		if(isset($items[0])){
			$this->setAllData($items[0]);
		}
	}
}
