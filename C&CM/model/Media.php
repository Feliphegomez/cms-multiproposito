<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * Git: https://github.com/Feliphegomez/crm-crud-api-php
 * *******************************
 */

class Media extends EntidadBase {
	public $adapter;
	
    public function __construct($adapter) {
		$this->adapter = $adapter;
        $table = TBL_MEDIA_FILES;
        parent::__construct($table, $adapter);
    }
	
	public function getById($id){
		$id = (isset($id) && $id > 0) ? $id : 0;
		$items = parent::getById($id);
		if(isset($items[0])){
			$this->setAllData($items[0]);
		}
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
			
            // $media->set($post["email"]);
            // $save=$usuario->save();
            // $media = new Media($this->adapter);
			$sql = "INSERT INTO " . parent::getTable() . " (name, type, size, path_full, path_short) VALUES (?,?,?,?,?)";
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
	
    public function eliminar(){
        if(isset($this->id) && $this->id > 0){
			try {
				$sql = "DELETE FROM " . parent::getTable() . " WHERE id=?";
				$query = $this->db()->prepare($sql);
				$query->execute([$this->id]);
				return true;
			}
			catch(PDOException $e){
				#echo $sql . "<br>" . $e->getMessage();
				return false;
			}
		}else{
			return false;
		}
        // $this->redirect("Usuarios", "index");
    }
}