<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * Git: https://github.com/Feliphegomez/crm-crud-api-php
 * *******************************
 */

class LoginController extends ControladorBase {
	public $user;
	public $post;
	
    public function __construct() {
        parent::__construct();
		$this->post = (isset($_POST)) ? $_POST : null;
		$this->user = new Usuario();
		
		if(isset($_SESSION['user']) && get_called_class() != 'LoginController'){
			$this->user->getById($_SESSION['user']['id']);
			// @header("Location: /");
			//exit();
		}
    }
	
    public function index(){
		$this->viewSystemInTemplate(
			"login", array(
				"title" => "Bienvenid@",
				"subtitle" => "",
				"description" => "Por favor ingrese sus datos para acceder al portal.",
				"post" => $this->post,
				"user" => $this->user,
			)
		);
    }
	
    public function create(){
		$this->viewSystemInTemplate(
			"register", array(
				"title" => "Bienvenid@",
				"subtitle" => "",
				"description" => "Por favor ingrese sus datos para acceder al portal.",
				"post" => $this->post,
				"user" => $this->user,
			)
		);
    }
	
    public function login(){
		$this->viewSystemInTemplate(
			"password", array(
				"title" => "Hola {$this->user->names}",
				"user" => $this->user,
				"subtitle" => "",
				"description" => "Por favor ingrese su contraseña para acceder.",
				"post" => $this->post,
				"user" => $this->user,
			)
		);
	}
	
    public function error($title = "Error", $message = ""){
		if($message == "" && isset($_GET['message']))
		{
			$message = base64_decode($_GET['message']);
		}
		$this->viewSystemInTemplate(
			"loginError", array(
				"title" => $title,
				"subtitle" => "",
				"description" => "Los datos estan incorrectos intenta nuevamente.",
				"post" => $this->post,
				"user" => $this->user,
			)
		);
    }
	
	public function register(){
		$infoView = array(
			"title" => "Crear Cuenta",
			"subtitle" => "",
			"description" => "Rellena el formulario para crear tu cuenta.",
			"post" => $this->post,
			"user" => $this->user
		);
		
		if(
			isset($this->post['username'])
			&& isset($this->post['password'])
			&& isset($this->post['email'])
		){
			$this->post['password'] = password_hash($this->post['password'], PASSWORD_DEFAULT);
			$user = new Usuario();
			$user->set('username', $this->post['username']);
			$user->set('password', $this->post['password']);
			$user->set('email', $this->post['email']);
			// $user->create($this->post);
			$create = $user->create($this->post);
			echo json_encode($create);
			
			if($create->error == true){
				$infoView["description"] = $create->errorInfo;
			}else{
				$infoView["description"] = "Tu cuenta fue creada correctamente.";
			}
			
		}
		$this->viewSystemInTemplate("register", $infoView);
	}
	
	public function searchUserLogin($identification_type, $identification_number){
		$usuario = $this->user = new Usuario();
		
		if($identification_type != null && $identification_number != null){ $usuario->getByUsername("{$this->identification_type}:{$this->identification_number}"); };
		
		if($usuario->isUser()){ return true; } 
		else { return false; }
	}
}