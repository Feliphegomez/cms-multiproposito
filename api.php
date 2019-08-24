<?php 

//REQUIERE APIBASE::
#require_once 'C&CM/autoload.php';
require_once 'C&CM/config/settings.php';
require_once 'C&CM/config/database.php';
$configAPI = require_once 'C&CM/config/api.php';
require_once 'C&CM/core/ApiBase.php';

#$home = new AppBase();
#$home->runAPI();
/*
namespace FelipheGomez\PhpCrudApi {
    use FelipheGomez\PhpCrudApi\Api;
    use FelipheGomez\PhpCrudApi\Config;
    use FelipheGomez\PhpCrudApi\RequestFactory;
    use FelipheGomez\PhpCrudApi\ResponseUtils;

	$configAPI = require_once folder_data . '/config/api.php';
    $config = new Config($configAPI);
    $request = RequestFactory::fromGlobals();
    $api = new Api($config);
    $response = $api->handle($request);
    #ResponseUtils::output($response);
}*/
use FelipheGomez\PhpCrudApi\Api;
use FelipheGomez\PhpCrudApi\Config;
use FelipheGomez\PhpCrudApi\RequestFactory;
use FelipheGomez\PhpCrudApi\ResponseUtils;

$config = new Config($configAPI);
$request = RequestFactory::fromGlobals();
$api = new Api($config);
$response = $api->handle($request);
ResponseUtils::output($response);