<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

return [
	'driver' => DB_driver,
	'address' => DB_host,
	'port' => DB_port,
	'username' => DB_user,
	'password' => DB_pass,
	'database' => DB_database,
	'middlewares' => 'dbAuth,authorization,sanitation,pageLimits,validation,multiTenancy,customization,cors', // => Disabled , ,,xsrf,jwtAuth,xsrf,ipAddress
	'controllers' => 'records,columns,openapi,geojson,cache',
	'cacheType' => 'NoCache', // TempFile
	'cachePath' => '../../../tmp',
	'cacheTime' => 1000,
	'debug' => true,
	// 'basePath' => '/api.php',
	'openApiBase' => '{"info":{"title":"API-REST","version":"1.0.0"}}',
	'dbAuth.mode' => 'optional',
	'dbAuth.usersTable' => 'users',
	'dbAuth.usernameColumn' => 'username',
	'dbAuth.passwordColumn' => 'password',
	'dbAuth.returnedColumns' => '',
	'authorization.columnHandler' => function ($operation, $tableName, $columnName) {
		if($operation == 'create' && $tableName == 'users'){
			return true;
		} else {
			return !($tableName == 'users' && $columnName == 'password');
		}
	},
	'validation.handler' => function ($operation, $tableName, $column, $value, $context) {
		return ($column['name'] == 'post_id' && !is_numeric($value)) ? 'must be numeric' : true;
    },
	'sanitation.handler' => function ($operation, $tableName, $column, $value) {
		if($operation == 'create' || $operation == 'update'){
			if($column['name'] == 'password'){
				return is_string($value) ? password_hash($value, PASSWORD_DEFAULT) : password_hash(strip_tags($value), PASSWORD_DEFAULT);
			}else{
				return is_string($value) ? ($value) : $value;
			}
		}else{
			return is_string($value) ? strip_tags($value) : $value;
		}
	},
	'authorization.tableHandler' => function ($operation, $tableName) {
		$a = false;
		if($operation == 'list' || $operation == 'read'){
			switch($tableName){
				case 'geo_citys':
					$a = true;
				break;
				case 'geo_departments':
					$a = true;
				break;
				case 'geo_citys':
					$a = true;
				break;
				case 'identifications_types':
					$a = true;
				break;
				case 'requests_types':
					$a = true;
				break;
				default:
					$a = false;
				break;
			}
		}else{
			if($operation == 'create'){
				switch($tableName){
					case 'users':
						$a = true;
					break;
					default:
						$a = false;
					break;
				}
			}
		}
		return ($tableName == 'login' || $operation == 'login') ? true : $a;
    },
	'authorization.recordHandler' => function ($operation, $tableName) {
		$a = true;
		return $a;
	},
	#'ipAddress.tables' => 'barcodes',
	#'ipAddress.columns' => 'ip_address',
	# 'pageLimits.pages' => 25,
	# 'pageLimits.records' => 25,
	/*
	'jwtAuth.mode' => 'optional',
    'jwtAuth.ttl' => '1538207605',
    'jwtAuth.time' => '1538207605',
    'jwtAuth.header' => 'X-Authorization',
    'jwtAuth.leeway' => '1000',
    'jwtAuth.secret' => 'Qgm7JByh8pdrtEsXjRoRk6BoBfa32pAG0dtuCtVs2y1MovieFODlrf4i1gKdOZ6vUH1DIPEso2ipQy4jt8IwZ4FMnCHPrP97QdF5a8ywa5AXlWuRzJWZ5ZkU7FJrc1ZZ',
    'jwtAuth.algorithms' => '',
    'jwtAuth.audiences' => '',
    'jwtAuth.issuers' => '',*/
	#'cors.allowedOrigins' => "*",
	#'cors.allowCredentials' => true,
	/*
	'authorization.tableHandler' => function ($operation, $tableName) {
		$a = true;
		switch($tableName){
			case 'geo_citys':
				
				break;
			case 'invisibles':
				$a = false;
				break;
		}
		if($operation == 'list' || $operation == 'read'){
			$a = true;
		}
		return $a;
	},
	'authorization.recordHandler' => function ($operation, $tableName) {
		$a = true;
		switch($tableName){
			case 'users':
				// no permitirá el acceso a los registros de usuario donde el nombre de usuario es "admin".
				// Esta construcción agrega un filtro a cada consulta ejecutada.
				$a = ($tableName == 'users') ? 'filter=username,neq,admin' : '';
				break;
			case 'comments':
				// no permitirá el acceso a los registros de la tabla comments donde el mensaje sea "invisible".
				// Esta construcción agrega un filtro a cada consulta ejecutada.
				$a = ($tableName == 'comments') ? 'filter=message,neq,invisible' : '';
				break;
		};
		return $a;
	},*/
];
