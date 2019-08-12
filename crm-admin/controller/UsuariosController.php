<?php 
class UsuariosController extends ControladorBase {
	
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
		
		$this->viewSystemInTemplate(
			"mi_perfil_edit", array(
				"title" => "mi_perfil",
				"user" => $userInfo,
			)
		);
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