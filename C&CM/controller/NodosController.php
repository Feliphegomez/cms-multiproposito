<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class NodosController extends ControladorBase {
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		#echo "mostrar nodo principal. slug principal_page\n";
		$nodo = new Nodo($this->adapter);
		if(isset($_GET['node_id'])){
			$nodo->getById($_GET['node_id']);
		}else{
			$nodo->current();
		}
		
		if($nodo->isValid() === true){
			$this->view($nodo->type->view, $nodo->type->template, (array) $nodo);
		}else{
			$this->viewSystem('error', array(
				"error_code" => "404",
				"title" => "Error 404",
				"message" => "Pagina no encontrada.",
				"advice" => "El nodo no existe."
			));
		}
	}
}