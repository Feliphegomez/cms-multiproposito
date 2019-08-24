<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class Picture extends EntidadBase {
	public $adapter;
	
    public function __construct($adapter) {
		$this->adapter = $adapter;
        $table = TBL_PICTURES;
        parent::__construct($table, $adapter);		
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
	
	public function getUrl(){
		return ($this->isValid() == true) ? "/index.php?controller=Picture&id={$this->id}" : IMAGE_DEFAULT;
	}
	
	public function getById($id=0){
		$id = (isset($id) && $id > 0) ? $id : 0;
        $items = parent::getById($id);
		if(isset($items[0])){
			$this->setAllData($items[0]);
		};
	}
		
	public function setAllData($item){
		parent::setAllData($item);
	}
}