<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class AppBase {
	public function __construct(){
		require_once folder_data . '/core/ControladorBase.php';
		require_once folder_data . '/core/ControladorFrontal.func.php';
		
	}
	
	public function runSite(){
		//Cargamos controladores y acciones
		$controller = (isset($_GET["controller"])) ? $_GET["controller"] : CONTROLADOR_DEFECTO;
		$controllerObj=cargarControlador($controller);
		lanzarAccion($controllerObj);
	}
	
	public function runAPI(){
		$controllerObj=cargarControlador('Api');
		lanzarAccion($controllerObj);
	}
}

