<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class SACController extends ControladorBase{
    public function __construct() {
        parent::__construct();
    }
     
    public function index(){
    }
     
    public function inbox(){
        $this->view("inboxSAC",array(
            "title"    =>"SAC - Bandeja de entrada"
        ));
    }
     
    public function pqrsf(){
        $this->view("pqrsf_about",array(
            "title"    =>"¿ QUE ES PQRSF ?"
        ));
    }
	
    public function requests_new(){
        $this->view("requests_new",array(
            "title"    =>"Nuevas Solicitudes"
        ));
    }
}