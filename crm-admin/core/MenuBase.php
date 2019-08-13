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
}
