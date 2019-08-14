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
		
		#if(isset($_SESSION['user']) && get_called_class() != 'LoginController'){
		if(isset($_SESSION['user']) && is_array($_SESSION['user']) && isset($_SESSION['user']['id']) && $_SESSION['user']['id'] > 0){
			$this->user->getById($_SESSION['user']['id']);
			#@header("Location: /");
			#exit();
		}
    }
	
    public function index(){
		if($this->user->id > 0){
			//@header("Location: /");
			//exit();
		}
		$infoView = array(
			"title" => "Bienvenido(a)",
			"subtitle" => "",
			"description" => "Por favor ingrese sus datos para acceder al portal.",
			"post" => $this->post,
			"user" => $this->user
		);
		
		if(
			isset($this->post['username'])
			&& isset($this->post['password'])
		){
			$solvemedia_response = solvemedia_check_answer(SM_KEY_PRIVATE,
								$_SERVER["REMOTE_ADDR"],
								$this->post["adcopy_challenge"],
								$this->post["adcopy_response"],
								SM_HASH);
			if (!$solvemedia_response->is_valid) {
				if($solvemedia_response->error == 'incorrect-solution'){
					$solvemedia_response->error = 'Ingrese las letras del codigo de seguridad.';
				}
				else if($solvemedia_response->error == 'already checked'){
					$solvemedia_response->error = 'Codigo de verificación incorrecto.';
				}
				$_POST = array();
				$infoView["description"] = "<span class=\"alert alert-danger\">{$solvemedia_response->error}</span> ";
			} 
			else {
				$login = new API_CLIENT();
				$login->setMethod("POST");
				$login->setURL(urlActual().'/login');
				$login->setData(array(
					'username' => $this->post['username'],
					'password' => $this->post['password']
				));
				$login->Run();
				$reponse = $login->Response();
					
				if(isset($reponse->id) && $reponse->id > 0){
					$_SESSION['user'] = array();
					$infoView["description"] = "<span class=\"alert alert-success\">Hola, {$reponse->username}.</span>";
					
					foreach($reponse as $k=>$v){
						$_SESSION['user'][$k] = $v;
					}
					@header("Location: /");
				}else{
					$infoView["description"] = "<span class=\"alert alert-danger\">Datos incorrectos, intenta nuevamente.</span>";
				}
			}
			
			
		}
		$this->viewSystemInTemplate("login", $infoView);
    }
	
    private function hasCorrectPassword(string $password, string $hash): bool {
		return (password_verify('rasmuslerdorf', $hash)) ? true : false;
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
			$solvemedia_response = solvemedia_check_answer(SM_KEY_PRIVATE,
								$_SERVER["REMOTE_ADDR"],
								$this->post["adcopy_challenge"],
								$this->post["adcopy_response"],
								SM_HASH);
			if (!$solvemedia_response->is_valid) {
				$infoView["description"] = "Error: ".$solvemedia_response->error;
			} 
			else {
				$this->post['password'] = password_hash($this->post['password'], PASSWORD_DEFAULT);
				$user = new Usuario();
				$user->set('username', $this->post['username']);
				$user->set('password', $this->post['password']);
				$user->set('email', $this->post['email']);
				// $user->create($this->post);
				$create = $user->create($this->post);
				
				if($create->error == true){
					$infoView["description"] = $create->errorInfo;
				}else{
					$infoView["description"] = "Tu cuenta fue creada correctamente.";
				}
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