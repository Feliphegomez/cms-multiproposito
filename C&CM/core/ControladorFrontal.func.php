<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

//FUNCIONES PARA EL CONTROLADOR FRONTAL

require_once(folder_data . "/core/libs/solvemedia/solvemedialib.php");
 
function cargarControlador($controller){
    $controller = (LOGIN_REQ === true) ? (isUser() == true ? $controller : 'login') : $controller;
    $controlador = ucwords($controller).'Controller';
	$folder_system = (folder_data . '/controller/'.$controlador.'.php');
	
	if(is_file($folder_system)){ $strFileController = $folder_system; }
	# else if(!is_file($folder_system) && is_file($folder_modules)){ $strFileController = $folder_modules; }
	else {
		 exit("Error: problema en el controlador. " . ucwords($controller));
		
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

function isUser($redirect=false){
	if($redirect === false){
		return (!isset($_SESSION) || !isset($_SESSION['user']) || !isset($_SESSION['user']['id'])) ? false : true;
	}else{
		return (!isset($_SESSION) || !isset($_SESSION['user']) || !isset($_SESSION['user']['id'])) ? "<meta http-equiv=\"Refresh\" content=\"0; url=/\">" : "";
	}
}

function validateSession($simple=false){
	return (isUser() != true) ? array() : $simple == true && isset($_SESSION['user']) ? $_SESSION['user'] : $_SESSION;
}

function returnParamsUrl($z){
	$a = '';
	if(is_object($z) || is_array($z)){ foreach($z as $k => $v){ $a .= $k . '=' . returnParamsUrl($v); } } 
	else { $a .= $z; }
	return $a;
}

function linkUrl($controlador=CONTROLADOR_DEFECTO, $accion=ACCION_DEFECTO, $params=null){
	$urlParams = returnParamsUrl($params);
	return ("/index.php?controller={$controlador}&action={$accion}&{$urlParams}");
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

function urlActual($enable_this_file=false){
	$protocol = @$_SERVER['HTTP_X_FORWARDED_PROTO'] ?: @$_SERVER['REQUEST_SCHEME'] ?: ((isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") ? "https" : "http");
	$port = @intval($_SERVER['HTTP_X_FORWARDED_PORT']) ?: @intval($_SERVER["SERVER_PORT"]) ?: (($protocol === 'https') ? 443 : 80);
	$host = @explode(":", $_SERVER['HTTP_HOST'])[0] ?: @$_SERVER['SERVER_NAME'] ?: @$_SERVER['SERVER_ADDR'];
	$port = ($protocol === 'https' && $port === 443) || ($protocol === 'http' && $port === 80) ? '' : ':' . $port;
	$path = @trim(substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '/openapi')), '/');
	$this_file = substr($_SERVER['SCRIPT_NAME'],1);
	
	return ($enable_this_file == true) ? "{$protocol}"."://{$host}{$port}{$path}{$this_file}" : "{$protocol}"."://{$host}{$port}{$path}";
}

function urlTema(){
	return "/crm-content/themes/" . TEMA_DEFECTO;
}

function urlPictureById($id){
	return "/index.php?controller=Sistema&action=picture&id={$id}";
}

function MenuToUL($datos=null){
	$r = "";
	if($datos != null){
		$r .= "<div class=\"menu_section\">";
			$r .= "<h3>{$datos->name}</h3>";
			$r .= "<ul class=\"nav side-menu\">";
				foreach($datos->childs as $item_menu){
					$r .= "<li>";
						$r .= createItemHtmlLink($item_menu);
						$r .= (isset($item_menu->childs) && count($item_menu->childs) > 0) ? createChildMenu($item_menu->childs) : '';
					$r .= "</li>";
				}
			$r .= "</ul>";
		$r .= "</div>";
	}
	return $r;
}

function createChildMenu($childs){
	$r = "<ul class=\"nav child_menu\">";
	foreach($childs as $child){
		$r .= "<li>";
			$r .= createItemHtmlLink($child);
			$r .= (isset($child->childs) && count($child->childs) > 0) ? createChildMenu($child->childs) : '';
		$r .= "</li>";
	}
	$r .= "</ul>";
	return $r;
}

function createItemHtmlLink($item_menu){
	$item_menu->tag_id = (isset($item_menu->tag_id) && $item_menu->tag_id != null && $item_menu->tag_id != "") ? $item_menu->tag_id : generateRandomString();
	$item_menu->tag_class = (isset($item_menu->tag_class) && $item_menu->tag_class != null && $item_menu->tag_class != "") ? " class=\"{$item_menu->tag_class}\" " : ' ';
	$item_menu->tag_href = (isset($item_menu->tag_href) && $item_menu->tag_href != null && $item_menu->tag_href != "") ? $item_menu->tag_href : '#';
	$item_menu->icon = (isset($item_menu->icon) && $item_menu->icon != null && $item_menu->icon != "") ? " <i class=\"{$item_menu->icon}\"></i> " : '';
	$item_menu->title = 
		(isset($item_menu->childs) && count($item_menu->childs) > 0) 
			? " {$item_menu->title} <span class=\"fa fa-chevron-down\"></span> " 
			: " {$item_menu->title} ";
		$r = "<a id=\"{$item_menu->tag_id}\" href=\"{$item_menu->tag_href}\">{$item_menu->icon} {$item_menu->title} </a>";
		$r = "<a id=\"{$item_menu->tag_id}\" href=\"{$item_menu->tag_href}\">{$item_menu->icon} {$item_menu->title} </a>";
	return $r;
}

function getPermissions($adapter){
	$user = validateSession();
	if(isset($user['user']['permissions']->id) && (int) $user['user']['permissions']->id > 0){
		$permisoID = (int) $user['user']['permissions']->id;
		$perm = new Permiso($adapter);
		$perm->getById($permisoID);
	} else if(isset($user['user']['permissions']) && (int) $user['user']['permissions'] > 0){
		$permisoID = (int) $user['user']['permissions'];
		$perm = new Permiso($adapter);
		$perm->getById($permisoID);
	} else {
		$perm = new stdClass();
	}
	return ($perm);
}

function validatePermission($adapter, $module, $action){
	$t = getPermissions($adapter);
	$p = (isset($t->data)) ? $t->data : new stdClass();
	
	if(isset($p->{"isAdmin"}) && $p->{"isAdmin"} == true){
		return true;
	} else {
		if($action == null){
			return (isset($p->{$module})) ? true : false;
		}else{
			return (isset($p->{$module}->{$action}) && $p->{$module}->{$action} == true) ? true : false;
		}
	}
}

function getPowerBy(){
	return "Power by <a href=\"https://github.com/Feliphegomez\">Feliphegomez</a>";
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
		$this->response = @json_decode(@file_get_contents($this->url, true, stream_context_create($opts)));
	}
	
	public function Response(){ return $this->response; }
}