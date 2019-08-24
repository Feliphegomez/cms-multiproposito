<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class LoginController extends ControladorBase{
    public $conectar;
    public $adapter;
	public $user;
	
    public function __construct() {
        parent::__construct();
        $this->conectar=new Conectar();
        $this->adapter=$this->conectar->conexion();
		
		if(isset($_SESSION['user']) && get_called_class() != 'LoginController'){
			@header("Location: /");
			exit();
		}
		$this->user = new Usuario($this->adapter);
		if(isset($_SESSION['user']) && is_array($_SESSION['user']) && isset($_SESSION['user']['id']) && $_SESSION['user']['id'] > 0){
			$this->user->getById($_SESSION['user']['id']);
			#@header("Location: /");
			#exit();
		}
    }
	
    public function index(){
		$this->view(
			"login", 'no_menus', array(
				"title" => "Bienvenid@",
				"subtitle" => "",
				"description" => "Por favor ingrese sus datos para acceder al portal."
			)
		);
    }
	
    public function create(){
		$this->view(
			"login", 'no_menus', array(
				"title" => "Bienvenid@",
				"subtitle" => "",
				"description" => "Por favor ingrese sus datos para acceder al portal."
			)
		);
    }
	
    public function validate(){
		if($this->user->id > 0){
			@header("Location: /");
			exit();
		}
		$infoView = array(
			"title" => "Bienvenido(a)",
			"subtitle" => "",
			"description" => "Por favor ingrese sus datos para acceder al portal.",
			"post" => $this->post,
			"user" => $this->user
		);
    }
}