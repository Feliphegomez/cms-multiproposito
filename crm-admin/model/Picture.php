<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * Git: https://github.com/Feliphegomez/crm-crud-api-php
 * *******************************
 */

class Picture extends EntidadBase {
    public function __construct($params) {
        $table = TBL_PICTURES;
        parent::__construct($table);
		if(isset($items[0])){
			foreach($items[0] as $k=>$v){
				$this->{$k} = $v;
			}
		}
		
    }
	
	public function __toString(){
		return ($this->getName());
	}
	
	public function getId(){
		return ($this->id == null) ? 0 : (int) $this->id;
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
}