<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class AyudaVistas {
	public $page;
	
	public function __construct(){
		$this->page = new stdclass();
		$this->page->allheaders = getallheaders();
		// $arr = get_defined_vars();
	}
	
    public function url($controlador=CONTROLADOR_DEFECTO,$accion=ACCION_DEFECTO){
        $urlString="index.php?controller=".$controlador."&action=".$accion;
        return $urlString;
    }
     
    //Helpers para las vistas
	
    public function output(){
        $data = "<p>This out in AyudaVistas</p>";
        #$data = "<p>" . $this->model->tstring ."</p>";
        #require_once($this->model->template);
		#folder_data
    }
}
