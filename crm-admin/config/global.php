<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * Git: https://github.com/Feliphegomez/crm-crud-api-php
 * *******************************
 */
 
define("REQUIERE_LOGIN", false);
define("TEMA_DEFECTO", "default");
define("REDIRECT_LOGIN", REQUIERE_LOGIN);
define("CONTROLADOR_DEFECTO", "Nodes");
define("ACCION_DEFECTO", "index");


define("TITLE_LG", "CMS & CRM MULTI-PROPOSITO - Developer by FelipheGomez");
define("TITLE_MD", "CMS Y CRM MULTI-PROPOSITO");
define("TITLE_SM", "C&C MULTI");
define("TITLE_XS", "C&CM");
define("ICON_DEFAUL", "fa fa-leaf");
define("IMAGE_DEFAULT", "/crm-content/uploads/avatar001.jpg");

// SolveMedia Capcha
define("SM_KEY_PUBLIC", "J0Myui2rYs-6Ww2Y6dx4bn47Mn6-nX4u");
define("SM_KEY_PRIVATE", "oU6nzE4Rx9HPdI3ut6Oaq.osFkwTTS0i");
define("SM_HASH", "CZXAq6rL6iFTZIAzodbm.c6U6lkXBiKr");
 
// Activar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Más constantes de configuración
$thisFile = (__FILE__);
$thisFileDirname = dirname($thisFile);
define('folder_config_global', $thisFileDirname);
define('folder_admin', dirname($thisFileDirname . '../'));
define('folder_principal', (dirname(folder_admin . '../')));
define('folder_content', ((folder_principal . '/crm-content')));

function getPath() : string {
	$a = null;
	
	if (!isset($_SERVER['REQUEST_URI'])) {
		$_SERVER['REQUEST_URI'] = '/';
	}
	$a = $_SERVER['REQUEST_URI'];
	return $a;
}
define('current_path', getPath());

$protocol = @$_SERVER['HTTP_X_FORWARDED_PROTO'] ?: @$_SERVER['REQUEST_SCHEME'] ?: ((isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") ? "https" : "http");
$port = @intval($_SERVER['HTTP_X_FORWARDED_PORT']) ?: @intval($_SERVER["SERVER_PORT"]) ?: (($protocol === 'https') ? 443 : 80);
$host = @explode(":", $_SERVER['HTTP_HOST'])[0] ?: @$_SERVER['SERVER_NAME'] ?: @$_SERVER['SERVER_ADDR'];
$port = ($protocol === 'https' && $port === 443) || ($protocol === 'http' && $port === 80) ? '' : ':' . $port;
$path = @trim(substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '/openapi')), '/');

/* TABLAS */
define('TBL_PERMISSIONS', 'permissions');
define('TBL_T_IDENTIFICATIONS', 'types_identifications');
define('TBL_USERS', 'users');
define('TBL_USERS_C_USERNAME', 'username');
define('TBL_USERS_C_PASSWORD', 'password');
define('TBL_NODES', 'nodes');
define('TBL_NODES_ITEMS', 'nodes_items');
define('TBL_TYPES_NODES', 'nodes_types');
define('TBL_OPTIONS', 'options');
define('TBL_LOGS', 'logs');
define('TBL_MENUS', 'menus');
define('TBL_MENUS_ITEMS', 'menus_items');
define('TBL_USERS_R_C', '');
define('TBL_PICTURES', 'pictures');

/* CONFIGURACION DE LA API */
define("API_openApiBase", '{"info":{"title":"API-REST","version":"2.0.0"}}');
define("API_controllers", 'records,columns,openapi,geojson,cache');
define("API_middlewares", 'cors,dbAuth,authorization,sanitation,ipAddress,pageLimits,validation,multiTenancy,customization'); // => Disabled jwtAuth, xsrf
define("API_dbAuth_mode", 'required');
define("API_dbAuth_usersTable", TBL_USERS);
define("API_dbAuth_usernameColumn", TBL_USERS_C_USERNAME);
define("API_dbAuth_passwordColumn", TBL_USERS_C_PASSWORD);
define("API_dbAuth_returnedColumns", TBL_USERS_R_C);
define("API_xsrf_cookieName", 'CRM-XSRF-TOKEN');
define("API_xsrf_headerName", 'CRM-XSRF-TOKEN');