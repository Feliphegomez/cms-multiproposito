<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class ApiController extends ControladorBase{
    private $driver;
    private $address, $user, $pass, $database, $charset, $port;
    private $config;
     
    public function __construct() {
		$file = (dirname(__FILE__) . '/../').'core/ApiBase.php';
        if(is_file($file)){
			require_once $file;
		}
    }
	
    public function index(){
			require_once folder_data . '/config/database.php';

			$configAPI = require_once folder_data . '/config/api.php';
			$config = new FelipheGomez\PhpCrudApi\Config($configAPI);
			$request = FelipheGomez\PhpCrudApi\RequestFactory::fromGlobals();
			$api = new FelipheGomez\PhpCrudApi\Api($config);
			$response = $api->handle($request);
			FelipheGomez\PhpCrudApi\ResponseUtils::output($response);
    }
}
