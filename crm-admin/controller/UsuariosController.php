<?php 
class UsuariosController extends ControladorBase {
	public $post;
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$this->viewInTemplate(
			"index", array(
				"title" => "mi_perfil",
				// "template" => $this->template,
			)
		);
	}
	
    public function mi_perfil(){
		$this->viewSystemInTemplate(
			"mi_perfil", array(
				"title" => "mi_perfil",
				// "template" => $this->template,
			)
		);
    }
	
    public function mi_perfil_edit(){
		$userInfo = new Usuario();
		$userInfo->getById($this->userData->id);
		
		$infoView = array(
			"title" => "Modificar Mi Perfil",
			"subtitle" => ".",
			"description" => "Recuerda mantener tus datos actualizados para que nuestro personal te pueda contactar de manera eficiente.",
			"post" => $this->post,
			"user" => $userInfo
		);
		
		if(isset($this->post['username'])){
			$userInfo = new Usuario();
			$userInfo->getById($this->userData->id);
			
			foreach($this->post as $k=>$v){
				$userInfo->set($k, $v);
			}
			$save = $userInfo->save();
			
			
			echo json_encode($save);
			exit();
		}
		$this->viewSystemInTemplate("mi_perfil_edit", $infoView);
		
    }
	
    public function wall(){
		$this->viewSystemInTemplate(
			"wall", array(
				"title" => "wall",
				// "template" => $this->template,
			)
		);
    }
}