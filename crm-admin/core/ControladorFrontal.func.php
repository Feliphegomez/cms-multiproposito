<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * Git: https://github.com/Feliphegomez/crm-crud-api-php
 * *******************************
 */

//FUNCIONES PARA EL CONTROLADOR FRONTAL

require_once("libs/solvemedia/solvemedialib.php");
 
function urlActual($enable_this_file=false){
	$protocol = @$_SERVER['HTTP_X_FORWARDED_PROTO'] ?: @$_SERVER['REQUEST_SCHEME'] ?: ((isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") ? "https" : "http");
	$port = @intval($_SERVER['HTTP_X_FORWARDED_PORT']) ?: @intval($_SERVER["SERVER_PORT"]) ?: (($protocol === 'https') ? 443 : 80);
	$host = @explode(":", $_SERVER['HTTP_HOST'])[0] ?: @$_SERVER['SERVER_NAME'] ?: @$_SERVER['SERVER_ADDR'];
	$port = ($protocol === 'https' && $port === 443) || ($protocol === 'http' && $port === 80) ? '' : ':' . $port;
	$path = @trim(substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '/openapi')), '/');
	$this_file = substr($_SERVER['SCRIPT_NAME'],1);
	
	return ($enable_this_file == true) ? "{$protocol}"."://{$host}{$port}{$path}{$this_file}" : "{$protocol}"."://{$host}{$port}{$path}";
}
 
function cargarControlador($controller){
    $controlador = ucwords($controller).'Controller';
	$folder_system = (folder_admin . '/controller/'.$controlador.'.php');
	$folder_modules = (folder_content . '/modules/'.ucwords($controller).'/'.$controlador.'.php');
	
	if(is_file($folder_system) && !is_file($folder_modules)){
		$strFileController = $folder_system;
	}
	else if(!is_file($folder_system) && is_file($folder_modules)){
		$strFileController = $folder_modules;
	}
	else if(is_file($folder_system) && is_file($folder_modules)){
		$strFileController = $folder_system;
	}
	else if(!is_file($folder_system) && !is_file($folder_modules)){
		exit("Error: Controlador no detectado. {$controller}");
	}
	else {
		exit("Error: problema en el controlador.");
	}
	
	if(@file_exists($strFileController)){		
		require_once $strFileController;
		$controllerObj = new $controlador();
		return $controllerObj;
	}
}
 
function cargarAccion($controllerObj,$action){
    $accion=$action;
    $controllerObj->$accion();
}
 
function lanzarAccion($controllerObj){
    if(isset($_GET["action"]) && method_exists($controllerObj, $_GET["action"])){
        cargarAccion($controllerObj, $_GET["action"]);
    }else{
        cargarAccion($controllerObj, ACCION_DEFECTO);
    }
}
function listar_directorios_ruta($ruta, $limit = 999999999999999){
	$r = array();
	if (is_dir($ruta)) {
		if ($dh = opendir($ruta)) {
			while (($file = readdir($dh)) !== false) {
				 if (count($r) == $limit) { break; }
				if($file != ".." && $file != "." && $file != ""){
					$item = new stdClass();
					$item->ruta = $ruta . $file;
					$item->name = $file;
					$item->tree = array();
					if (is_dir($ruta . $file) && $file!="." && $file!=".." && $file != ""){ $item->tree = listar_directorios_ruta($ruta . $file . "/", $limit); }
					$r[] = $item;
				}
				
			}
			closedir($dh); 
		} 
	} else {
	   # echo "<br>No es ruta valida";
	}
	return $r;
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


class API_CLIENT {
	public $method;
	public $data;
	public $url;
	public $response;
	
	public function __construct(){
		$this->method = 'GET';
		$this->data = array();
		$this->url = urlActual();
	}
	
	public function setMethod($method){ $this->method = $method; }
	
	public function setURL($url){ $this->url = $url; }
	
	public function setData($data){ $this->data = $data; }
	
	public function Run(){
		$opts = array('http' => array (
			'method' => $this->method,
			'header' => [
				'Content-type: application/xwww-form-urlencoded'
			],
			'content' => @http_build_query($this->data)
		));
		$context  = stream_context_create($opts);
		$this->response = @json_decode(@file_get_contents($this->url, false, $context));
	}
	
	public function Response(){ return $this->response; }
}