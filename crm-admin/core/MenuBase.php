<?php 


class MenuBase {
	public $datos;
	public $user;
	
	public $data;
	public $allmodules;
	
	public function __construct($column=null, $value=null){
		$this->user = (isset($_SESSION['user'])) ? $_SESSION['user'] : array();
		$this->datos = array();
		if($value != null && $column != null){
			$this->loadMenu($column, $value);
		}
	}
	
	public function loadMenu($column, $value){
		$this->datos = new Menu();
		$this->datos->getBy($column, $value);
		$this->loadChilds();
	}
	
	public static function getModules() : array {
		$Mydir = folder_content . '/modules/';
		$dirs = array();
		foreach(glob($Mydir.'*', GLOB_ONLYDIR) as $dir) {
			$dir = str_replace($Mydir, '', $dir);
			$dirs[] = $dir;
		}
		return $dirs;
	}
     
    public function linkUrl($controlador=CONTROLADOR_DEFECTO, $accion=ACCION_DEFECTO, $params=null){
		$urlParams = ControladorBase::returnParamsUrl($params);
        return ("index.php?controller={$controlador}&action={$accion}&{$urlParams}");
    }
     
    public function getAllBy($value, $column){
		$sql = "SELECT * FROM {$this->table} WHERE {$column}=? AND parent IN ('0')";
		$query = $this->db->prepare($sql);
		$query->execute([$value]);
		return $this->FetchList($query);
    }
 
    public function loadChilds(){
		$items = new MenuElements();
		$childs = $items->getAllBy($this->datos->id, 'menu');
		/*
		foreach($childs as $item){
			$continue = false;
			if($item->public == 1){
				$continue = true;
				
			} else if(($item->public == 0 && isset($_SESSION['user'])) && ControladorBase::validatePermission(ucwords($item->permision_controller), $item->permission_action)){
				$continue = true;
			}
			#else if($item->public == 1){}
			
			if($continue === true){
				items
			}
		}*/
	}
	
	public function toUL(){
		$r = '';
		if(!isset($this->childs)){
			# echo "No items en el menu.";
			# exit();
		}else{
			foreach($this->toTree($this->childs) as $item){
				echo json_encode($item);
			}
		}
		
		return $r;
	}
	
	public function toTree($nodes){
		$r = new stdclass();
		$i = 0;
		foreach($this->childs as $item){
			if($item->parent == $i){
				if(!isset($r->{$item->id})){
					$r->{$item->id} = $item;
					$r->{$item->id}->tree = array();
				}
			}
			$i++;	
			
			
			if(isset($item->id)){
				#$r->{$item->id}->tree = array();
			}
		}
		return $r;
	}
}
