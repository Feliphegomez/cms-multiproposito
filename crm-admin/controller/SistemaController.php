<?php 
class SistemaController extends ControladorBase {	
    public function __construct() {
        parent::__construct();
    }
	
    public function index(){
		
    }
	
    public function table_debug(){
		$this->viewSystemInTemplate(
			"debug", array(
				"title" => "Modo Debug",
			)
		);
    }
	
    public function database_vue(){
		$this->viewSystemInTemplate(
			"database_vue", array(
				"title" => "Administrador DB",
				// "template" => $this->template,
			)
		);
    }
	
    public function api_readme(){
		$this->viewSystemInTemplate(
			"api_readme", array(
				"title" => "Modo Debug",
				// "template" => $this->template,
			)
		);
    }
	
    public function api_docs(){
		$this->viewSystemInTemplate(
			"api_docs", array(
				"title" => "Documentacion API",
				// "template" => $this->template,
			)
		);
    }
	
    public function users_list(){
        //Creamos el objeto usuario
        $usuario = new Usuario();
        //Conseguimos todos los usuarios
        $allusers=$usuario->getAll();
        //Cargamos la vista index y le pasamos valores
		
		$this->viewSystemInTemplate(
			"users_list", array(
				"title" => "Todos los usuarios",
				"allusers"=>$allusers,
				// "template" => $this->template,
			)
		);
    }
	
    public function modules_list(){
		$this->viewSystemInTemplate(
			"modules_list", array(
				"title" => "Todos los modulos",
				// "template" => $this->template,
			)
		);
    }
	
    public function users_add(){
		$this->viewSystemInTemplate(
			"users_add", array(
				"title" => "Nuevo Usuario",
				// "template" => $this->template,
			)
		);
    }
	
    public function theme_list(){
		$this->viewSystemInTemplate(
			"theme_list", array(
				"title" => "Modo Debug",
				// "template" => $this->template,
			)
		);
    }
	
    public function settings(){
		$this->viewSystemInTemplate(
			"blank", array(
				"title" => "Modo Debug",
				// "template" => $this->template,
			)
		);
    }
	
    public function privacy(){
		$this->viewSystemInTemplate(
			"blank", array(
				"title" => "Modo Debug",
				// "template" => $this->template,
			)
		);
    }
	
    public function ads(){
		$this->viewSystemInTemplate(
			"blank", array(
				"title" => "Modo Debug",
				// "template" => $this->template,
			)
		);
    }
	
    public function header_and_footer_scripts(){
		$this->viewSystemInTemplate(
			"blank", array(
				"title" => "Modo Debug",
				// "template" => $this->template,
			)
		);
    }
	
    public function modules_editor(){
		$this->viewSystemInTemplate(
			"blank", array(
				"title" => "Modo Debug",
				// "template" => $this->template,
			)
		);
    }
	
    public function modules_add(){
		$this->viewSystemInTemplate(
			"blank", array(
				"title" => "Modo Debug",
				// "template" => $this->template,
			)
		);
    }
	
    public function gallery(){
		$this->viewSystemInTemplate(
			"gallery", array(
				"title" => "Modo Debug",
				// "template" => $this->template,
			)
		);
    }
	
    public function gallery_add(){
		$this->viewSystemInTemplate(
			"picture_create", array(
				"title" => "Modo Debug",
				// "template" => $this->template,
			)
		);
    }
	
    public function picture(){
		$this->viewSystem(
			"picture", array(
				"title" => "Modo Debug",
				// "template" => $this->template,
			)
		);
    }
	
    public function picture_editor(){
		$this->viewSystemInTemplate(
			"picture_editor", array(
				"title" => "Modo Debug",
				// "template" => $this->template,
			)
		);
    }
}