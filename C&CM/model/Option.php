<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * Git: https://github.com/Feliphegomez/crm-crud-api-php
 * *******************************
 */

class Option extends EntidadBase {
	public $adapter;
    
    public function __construct($adapter) {
		$this->adapter = $adapter;
        $table = TBL_OPTIONS;
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
	
	public function getBySlug($slug){
		$slug = (isset($slug) && $slug != "") ? $slug : 'error_404';
		$items = parent::getBy('slug', $slug);
		if(isset($items[0])){
			foreach($items[0] as $k=>$v){
				$this->{$k} = $v;
			}
		}
	}
}
