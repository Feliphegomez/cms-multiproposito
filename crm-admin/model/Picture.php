<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * Git: https://github.com/Feliphegomez/crm-crud-api-php
 * *******************************
 */

class Picture extends EntidadBase {	
    public function __construct() {
        $table = TBL_PICTURES;
        parent::__construct($table);		
    }
	
	public function __sleep(){
		return array(
			'id',
			'name',
			'description',
			'size',
			'type',
			'created',
			'updated'
		);
	}
	
	public function getName(){
		return ($this->name);
	}
	
	public function getType(){
		return ($this->type);
	}
	
	public function getData(){
		return ($this->data);
	}
	
	public function getById($id){
		$id = (isset($id) && $id > 0) ? $id : 0;
		$items = parent::getById($id);
		if(isset($items[0])){
			$this->setAllData($items[0]);
		}
	}
	
	public function getUrl(){
		return ($this->isValid() == true) ? "/index.php?controller=Sistema&action=picture&id={$this->id}" : IMAGE_DEFAULT;
	}
}