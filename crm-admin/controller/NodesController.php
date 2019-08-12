<?php 
class NodesController extends ControladorBase {
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		// echo "mostrar nodo principal. slug principal_page\n";
		$nodo = new Node();
		$nodo->principal();
		if($nodo->isValid() === true){
			// echo "El nodo es valido.\n" . json_encode($nodo);
			$info = array(
				'title' => $nodo->title,
				'node' => $nodo,
			);
			if ($nodo->type->system == 1){
				$this->viewSystemInTemplate($nodo->type->template, $info);
			} else {
				$this->viewInTemplate($nodo->type->template, $info);
			}
		}else{
			echo "El nodo no es valido.\n";
			exit();
		}
	}
}