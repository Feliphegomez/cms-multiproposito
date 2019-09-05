<?php
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class RequestsMedia extends EntidadBase {
	public $adapter;

  public function __construct($adapter) {
		$this->adapter = $adapter;
    $table = TBL_REQUESTS_MEDIA;
    parent::__construct($table, $adapter);
  }

	public function crear($post=array()){
			if(isset($post)){
				$arrayInsert = array();
				foreach($this->__sleep() as $k){
					if(isset($post[$k])){
						$this->set($k, $post[$k]);
						$arrayInsert[] = $post[$k];
					}
				}

				$sql = "INSERT INTO " . parent::getTable() . " (request, media) VALUES (?,?)";
				$query = $this->db()->prepare($sql);
				try {
					$success = $query->execute((array) $arrayInsert);
					return $this->db()->lastInsertId();
				}catch (Exception $e){
					throw $e;
					return 0;
				}
			}
			// $this->redirect("Usuarios", "index");
	}

}
