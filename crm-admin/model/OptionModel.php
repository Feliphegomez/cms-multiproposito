<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * Git: https://github.com/Feliphegomez/crm-crud-api-php
 * *******************************
 */

class OptionsModel extends ModeloBase {
    private $table;
     
    public function __construct(){
        $this->table = TBL_OPTIONS;
        parent::__construct($this->table);
    }
     
    //Metodos de consulta
    public function getUnUsuario(){
        $query = "SELECT * FROM " . TBL_OPTIONS . " LIMIT 1";
        $usuario = $this->ejecutarSql($query);
        return ($usuario);
    }
}