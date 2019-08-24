<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class ControladorBase{
    public $conectar;
    public $adapter;
	public $called_class;
	public $defined_vars;
	public $get;
	public $post;
	public $put;
	public $delete;
	public $files;
	public $page;
	public $api;
	public $myUser;
	
    public function __construct() {
        require_once folder_data . '/core/Conectar.php';
        require_once folder_data . '/core/EntidadBase.php';
        require_once folder_data . '/core/ModeloBase.php';
		require_once folder_data . '/core/ApiBase.php';
		require_once folder_data . '/config/database.php';
		$this->api = new stdClass();
		$this->api->configData = require_once folder_data . '/config/api.php';
		$this->api->config = new FelipheGomez\PhpCrudApi\Config($this->api->configData);
		$this->api->request = FelipheGomez\PhpCrudApi\RequestFactory::fromGlobals();
		$this->api->api = new FelipheGomez\PhpCrudApi\Api($this->api->config);
		$this->api->response = $this->api->api->handle($this->api->request);
		
        //Incluir todos los modelos
        foreach(glob(folder_data . "/model/*.php") as $file){
            require_once $file;
        }
        $this->conectar=new Conectar();
        $this->adapter=$this->conectar->conexion();
		$this->called_class = get_called_class();
		$this->defined_vars = get_defined_vars();
		$this->runPage();
		// $this->api = $file = 
    }
	
    //Plugins y funcionalidades
	private function runPage(){
		$this->get = isset($_GET) ? $_GET : null;
		$this->post = isset($_POST) ? $_POST : null;
		$this->put = isset($_PUT) ? $_PUT : null;
		$this->delete = isset($_DELETE) ? $_DELETE : null;
		$this->files = isset($_FILES) ? $_FILES : null;
		$this->myUser = isset($_SESSION['user']) ? json_decode(json_encode($_SESSION['user'])) : json_decode("{}");
		
		$this->page = new stdClass();
		$this->page->title = TITLE_LG;
		$this->page->title_md = TITLE_MD;
		$this->page->title_sm = TITLE_SM;
		$this->page->title_xs = TITLE_XS;
		$this->page->icon_default = ICON_DEFAUL;
		$this->page->picture_default = IMAGE_DEFAULT;
	}
	
	public function setTitle($title){
		$this->page->title = "{$title} | " . TITLE_LG;
	}
	
	public function getTitle(){
		return $this->page->title;
	}
	
	public function getIn($url){
		if(is_file($url)){
			require_once $url;
		};
	}
	
	public function getInclude($file){
		return is_file(folder_data . "/themes/".THEME_DEFAULT."/include/{$file}.php") ? $this->getIn(folder_data . "/themes/".THEME_DEFAULT."/include/{$file}.php") : false;
	}
	
	public function getDirTheme(){
		return ("/C&CM/themes/" . THEME_DEFAULT);
	}
	
	public function validar_vista($view){
		return (is_file(folder_data . "/themes/".THEME_DEFAULT."/layout/{$view}.php")) ? 'theme' : ((is_file(folder_data . "/view/{$view}View.php")) ? 'system' : 'no_detect');
	}
	
	public function validar_template($template){
		return is_file(folder_data . "/themes/".THEME_DEFAULT."/template/{$template}.php");
	}
	
	public function validar_errors(){
		return $this->validar_vista('error');
	}
	
	/*
	* Este método lo que hace es recibir los datos del controlador en forma de array
	* los recorre y crea una variable dinámica con el indice asociativo y le da el
	* valor que contiene dicha posición del array, luego carga los helpers para las
	* vistas y carga la vista que le llega como parámetro. En resumen un método para
	* renderizar vistas.
	*/
	public function viewSystem($vista, $datos){
		foreach ($datos as $id_assoc => $valor) { ${$id_assoc}=$valor; }
		$datos["all"] = !isset($datos["all"]) ? get_defined_vars() : $datos["all"];
        require_once folder_data . '/core/AyudaVistas.php';
        $helper = new AyudaVistas();
        require_once folder_data . "/view/{$vista}View.php";
	}
	
	public function viewTemplate($template, $vista, $dataView){
		foreach ($dataView as $id_assoc => $valor) { ${$id_assoc}=$valor; }
		$dataView["all"] = !isset($dataView["all"]) ? get_defined_vars() : $dataView["all"];
        require_once folder_data . '/core/AyudaVistas.php';
        $helper = new AyudaVistas();
		require_once (folder_data . "/themes/".THEME_DEFAULT."/template/{$template}.php");
	}
	
	/*
	* Este método lo que hace es recibir los datos del controlador en forma de array
	* los recorre y crea una variable dinámica con el indice asociativo y le da el
	* valor que contiene dicha posición del array, luego carga los helpers para las
	* vistas y carga la vista que le llega como parámetro. En resumen un método para
	* renderizar vistas.
	*/
	public function getPage($vista, $datos){
		foreach ($datos as $id_assoc => $valor) { ${$id_assoc}=$valor; }
		$datos["all"] = !isset($datos["all"]) ? get_defined_vars() : $datos["all"];
        require_once folder_data . '/core/AyudaVistas.php';
        $helper = new AyudaVistas();
		$existe_layout_in_theme = $this->validar_vista($vista);
		$url = '';
		switch($existe_layout_in_theme){
			case 'system':
				$url = folder_data . "/view/{$vista}View.php";
				$this->viewSystem($vista, $datos);
			break;
			case 'theme':
				$url = (folder_data . "/themes/".THEME_DEFAULT."/layout/{$vista}.php");
			break;
			default:
				$this->viewSystem('error', array(
					"error_code" => "404",
					"title" => "Error 404",
					"message" => "Falta la vista [{$vista}] en esta plantilla",
					"advice" => "Falta la vista [{$vista}]  en el tema."
				));
				exit();
			break;
		}
        require_once $url;
	}
	
	/*
	* Este método lo que hace es recibir los datos del controlador en forma de array
	* los recorre y crea una variable dinámica con el indice asociativo y le da el
	* valor que contiene dicha posición del array, luego carga los helpers para las
	* vistas y carga la vista que le llega como parámetro. En resumen un método para
	* renderizar vistas.
	*/
	public function view($vista,$template,$dataView=null){
		// 'theme' => 'AboutController', 'template' => 'AboutController'
		$dataView = (isset($dataView) && is_array($dataView)) ? $dataView : ((isset($template) && is_array($template) && $dataView == null) ? $template : array());
		$dataView = (isset($dataView) && is_array($dataView)) ? $dataView : ((isset($template) && is_array($template) && $dataView == null) ? $template : array());
		$dataView["all"] = !isset($dataView["all"]) ? get_defined_vars() : $dataView["all"];
			
		$template = (isset($template) && is_string($template)) ? $template : MASCARA_DEFECTO;
		$existe_template = $this->validar_template($template);
		$existe_layout_in_theme = $this->validar_vista($vista);
		$existe_template_errors = $this->validar_errors($template);
		
		// valores automaticos de la pagina
		if(isset($dataView['title'])){
			$this->setTitle($dataView['title']);
		}
		
		if($existe_template !== 'no_detect'){
			switch($existe_layout_in_theme){
				case 'system':
					//$this->viewSystem($vista, $dataView);
					$this->viewTemplate($template, $vista, $dataView);
				break;
				case 'theme':
					$this->viewTemplate($template, $vista, $dataView);
				break;
				default:
					$this->viewSystem('error', array(
						"error_code" => "404",
						"title" => "Error 404",
						"message" => "Falta la vista [{$vista}] en esta plantilla",
						"advice" => "Falta la vista [{$vista}]  en el tema."
					));
				break;
			}
		} else {
			$this->viewSystem('error', array(
				"error_code" => "404",
				"title" => "Error 404",
				"message" => "Falta la plantilla base en el tema",
				"advice" => "Cree la plantilla en el tema."
			));
		}
    }
     
    public function redirect($controlador=CONTROLADOR_DEFECTO,$accion=ACCION_DEFECTO){
        header("Location: /index.php?controller=".$controlador."&action=".$accion);
    }
	
    //Métodos para los controladores
	public function tableDebug($data){
		$keys = array();
		$values = array();
		$html = "<div class=\"container-debug table table-responsive\" style=\"width:100%\"><table class=\"table table-responsive\">";
		foreach($data as $k => $v){
			$html .= "<tr>";
			
			$html .= "<th>{$k}</th>";
			if(is_array($v) || is_object($v)){
				$html .= "<td>{$this->tableDebug($v)}</td>";
			}else{
				$html .= "<td>".($v)."</td>";
			}
			
			$html .= "</tr>";
		}
		$html .= "</table></div>";
		
		return $html;
	}
	
	public function debug(){
		$this->view('debug', null, array(
			"title" => "debug",
			"message" => "Pagina Debug Principal"
		));
	}
	public function index(){
		$this->view('index', null, array(
			"title" => "debug",
			"message" => "Pagina Debug Principal"
		));
	}
	
	public function loadMenu($column, $value, $enable_tree=false){
		$menu = new Menu($this->adapter);
		$menu->getBy($column, $value);
		if($enable_tree == true){
			if($menu->total_childs > 0){
				$items = new MenuElements($this->adapter);
				$childs = $items->getBy('menu', $menu->id);
				foreach($childs as $child){					 
					if($child->parent == 0){
						#if($enabled == true){
							$tree = new MenuElements($this->adapter);
							$child->childs = $tree->getAllby('parent', $child->id);
							$menu->childs[] = $child;
						#}
					}
				}
			}
		}
		return $menu;
	}
	
	public static function linkUrl($controlador=CONTROLADOR_DEFECTO, $accion=ACCION_DEFECTO, $params=null){
		return linkUrl($controlador, $accion, $params);
	}
}
