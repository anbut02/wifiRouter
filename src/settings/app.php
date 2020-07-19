	<?php

	session_start();
	
	
	require __DIR__ . '/../vendor/autoload.php';
	
	$config['displayErrorDetails'] = true;
	$config['addContentLengthHeader'] = false;

	$config['db']['host']   = 'localhost';
	$config['db']['user']   = 'root';
	$config['db']['pass']   = 'root';
	$config['db']['dbname'] = 'wifi_router';
	
	$app = new \Slim\App([
		'settings' => $config
	]);

	
	$container = $app->getContainer();
	
	$container['db'] = function ($c) {
		$db = $c['settings']['db'];
		$pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'],
			$db['user'], $db['pass']);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		return $pdo;
	};
	
	require __DIR__ . '/../routes/routes.php';
	require __DIR__ . '/../routes/login.php';
	require __DIR__ . '/../routes/area.php';
	require __DIR__ . '/../routes/role.php';
?>