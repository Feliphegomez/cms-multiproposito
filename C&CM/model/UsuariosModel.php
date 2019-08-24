<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class UsuariosModel extends ModeloBase{
    private $table;
     
    public function __construct($adapter){
        $this->table = TBL_USERS;
        parent::__construct($this->table, $adapter);
    }
     
    //Metodos de consulta
    public function getUnUsuario(){
        $query = "SELECT * FROM " . TBL_USERS . " LIMIT 1";
        $usuario = $this->ejecutarSql($query);
        return $usuario;
    }
}
