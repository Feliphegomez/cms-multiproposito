<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * Git: https://github.com/Feliphegomez/crm-crud-api-php
 * *******************************
 */

class Option extends EntidadBase {
    public $id;
    public $node;
    public $slug;
    public $name;
     
    public function __construct() {
		$table = TBL_OPTIONS;
        parent::__construct($table);
    }
	
	public function getById($id){
		$id = (isset($id) && $id > 0) ? $id : 0;
		$items = parent::getById($id);
		if(isset($items[0])){
			$this->id = $items[0]['id'];
			$this->node = $items[0]['node'];
			$this->slug = $items[0]['slug'];
			$this->name = $items[0]['name'];
		}
	}
	
	public function getBySlug($slug){
		$slug = (isset($slug) && $slug != "") ? $slug : 'error_404';
		$items = parent::getBy('slug', $slug);
		if(isset($items[0])){
			$this->id = $items[0]['id'];
			$this->node = $items[0]['node'];
			$this->slug = $items[0]['slug'];
			$this->name = $items[0]['name'];
		}
	}
}