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
	
    public function __construct() {
        parent::__construct();
		if(isset($_SESSION['user']) && get_called_class() != 'LoginController'){
			@header("Location: /");
			exit();
		}
    }
	
    public function index(){
		$this->viewSystemInTemplate(
			"login", array(
				"title" => "Bienvenid@",
				"subtitle" => "",
				"description" => "Por favor ingrese sus datos para acceder al portal."
			)
		);
    }
	
    public function create(){
		$this->viewSystemInTemplate(
			"register", array(
				"title" => "Bienvenid@",
				"subtitle" => "",
				"description" => "Por favor ingrese sus datos para acceder al portal."
			)
		);
    }
	
    public function login(){
		if($searchUser == true){
			$this->viewSystemInTemplate(
				"password", array(
					"title" => "Hola {$this->user->names}",
					"user" => $this->user,
					"subtitle" => "",
					"description" => "Por favor ingrese su contraseña para acceder."
				)
			);
		}else{
			$this->error('Upss', 'No hemos encontrado ninguna cuenta con estos datos.');
		}
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
				"description" => "Los datos estan incorrectos intenta nuevamente."
			)
		);
    }
	
	public function searchUserLogin($identification_type, $identification_number){
		$usuario = $this->user = new Usuario();
		
		if($identification_type != null && $identification_number != null){ $usuario->getByUsername("{$this->identification_type}:{$this->identification_number}"); };
		
		if($usuario->isUser()){ return true; } 
		else { return false; }
	}
}