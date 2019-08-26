<?php 

//REQUIERE APIBASE::
require_once 'C&CM/autoload.php';
require_once 'C&CM/config/settings.php';
require_once 'C&CM/config/database.php';
require_once 'C&CM/core/ApiBase.php';
require_once 'C&CM/core/ControladorFrontal.func.php';

use FelipheGomez\PhpCrudApi\Api;
use FelipheGomez\PhpCrudApi\Config;
use FelipheGomez\PhpCrudApi\RequestFactory;
use FelipheGomez\PhpCrudApi\ResponseUtils;

session_start();
if(isUser()){
	$configAPI = require_once 'C&CM/config/api.php';
}else{
	$configAPI = require_once 'C&CM/config/api-public.php';
}


$config = new Config($configAPI);
$request = RequestFactory::fromGlobals();
$api = new Api($config);
$response = $api->handle($request);
ResponseUtils::output($response);