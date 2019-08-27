<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class UsuariosController extends ControladorBase{
     
    public function __construct() {
        parent::__construct();
    }
     
    public function index(){
        $usuario = new Usuario($this->adapter);
        $allusers = $usuario->getAll();	
        
        //Cargamos la vista index y le pasamos valores
        $this->view("my_profile",array(
            "classe"=>$usuario,
            "allusers"=>$allusers,
            "Hola"    =>"Soy Víctor Robles"
        ));
    }
     
    public function inbox(){
        $this->view("inboxUser",'complete',array(
            
        ));
    }
     
    public function crear(){
        if(isset($_POST["names"])){
             
            //Creamos un usuario
            $usuario=new Usuario($this->adapter);
            $usuario->setNombre($_POST["names"]);
            $usuario->setApellido($_POST["surname"]);
            $usuario->setEmail($_POST["email"]);
            $usuario->setPassword(sha1($_POST["password"]));
            $save=$usuario->save();
        }
        $this->redirect("Usuarios", "index");
    }
     
    public function borrar(){
        if(isset($_GET["id"])){
            $id=(int)$_GET["id"];
             
            $usuario=new Usuario($this->adapter);
            $usuario->deleteById($id);
        }
        $this->redirect();
    }
     
     
    public function hola(){
        $usuarios = new UsuariosModel($this->adapter);
        $usu = $usuarios->getUnUsuario();
        var_dump($usu);
    }
 
}
