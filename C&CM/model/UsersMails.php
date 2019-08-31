<?php
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class UsersMails extends EntidadBase{
	public $adapter;

    public function __construct($adapter) {
		$this->adapter = $adapter;
        $table = TBL_USERS_MAILS;
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
			foreach($item as $k=>$v){
				$this->{$k} = $v;

			}
		}

    public function getAllByUser($user){
			$items = parent::getBy('user', $user);
			$r = array();
			foreach($items as $child) {
				$r[] = $child;
			}
			return $r;
    }
	
    public function getAllById($id){
			$items = parent::getBy('id', $id);
			$r = array();
			foreach($items as $child) {
				$r[] = $child;
			}
			return $r;
    }

    public function getAllBy($column, $value){
			$items = parent::getBy($column, $value);
			$r = array();
			foreach($items as $child) {
				$r[] = $child;
			}
			return $r;
    }

}
