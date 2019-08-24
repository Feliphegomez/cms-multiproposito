<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class PictureController extends ControladorBase{
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
		$pictureId = (isset($this->get['id']) && $this->get['id'] > 0) ? (int) $this->get['id'] : 0;
		$picture = new Picture($this->adapter);
		$picture->getById($pictureId);
		$this->viewSystem(
			"viewPicture", array(
				"title" => "Modo Debug",
				"picture" => $picture,
			)
		);
    }
	
    public function create(){
		// generateImage($_POST['image']);
		$this->viewSystem(
			"createPicture", array(
				"title" => "Modo Debug",
			)
		);

	}
}