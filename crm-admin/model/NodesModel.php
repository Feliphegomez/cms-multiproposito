<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * Git: https://github.com/Feliphegomez/crm-crud-api-php
 * *******************************
 */

class NodesModel extends ModeloBase {
    private $table;
     
    public function __construct(){
        $this->table = TBL_NODES;
        parent::__construct($this->table);
    }
     
    //Metodos de consulta
    public function getUnUsuario(){
        $query = "SELECT * FROM " . TBL_NODES . " LIMIT 1";
        $usuario = $this->ejecutarSql($query);
        return ($usuario);
    }
	
}