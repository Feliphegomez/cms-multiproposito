<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class Usuario extends EntidadBase{
	public $adapter;
     
    public function __construct($adapter) {
		$this->adapter = $adapter;
        $table = TBL_USERS;
        parent::__construct($table, $adapter);
    }
     
    public function getId() {
        return $this->id;
    }
 
    public function setId($id) {
        $this->id = $id;
    }
     
    public function getNombre() {
        return $this->names;
    }
 
    public function setNombre($nombre) {
        $this->names = $nombre;
    }
 
    public function getApellido() {
        return $this->surname;
    }
 
    public function setApellido($apellido) {
        $this->surname = $apellido;
    }
 
    public function getEmail() {
        return $this->email;
    }
 
    public function setEmail($email) {
        $this->email = $email;
    }
 
    public function getPassword() {
        return $this->password;
    }
 
    public function setPassword($password) {
        $this->password = $password;
    }
 
    public function save(){
        $query="INSERT INTO " . TBL_USERS . " (id,names,surname,email,password)
                VALUES(NULL,
                       '".$this->names."',
                       '".$this->surname."',
                       '".$this->email."',
                       '".$this->password."');";
        $save=$this->db()->query($query);
        //$this->db()->error;
        return $save;
    }
 
}
