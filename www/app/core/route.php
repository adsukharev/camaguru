<?php

class Route {

	static function start() {
		ROUTE::checkXSS();
		$controller_array = ROUTE::getUri();
		$controller_name = $controller_array[0];
		$controller_method = $controller_array[1];
		ROUTE::initModel($controller_name);
		ROUTE::initController($controller_name);
		ROUTE::initMethod($controller_name, $controller_method);
	}

	static function getUri(){
		$controller_name = 'main';
		$controller_method = 'index';
		$routes = explode('/', $_SERVER['REQUEST_URI']);

		if (!empty($routes[1])){
			$controller_name = $routes[1];
		}
		if (!empty($routes[2])){
			$controller_method = $routes[2];
		}

		$posName = strpos($controller_name, '?');
		if ($posName){
			$controller_name = substr($controller_name, 0, $posName);
		}
		$posMethod = strpos($controller_method, '?');
		if ($posMethod){
			$controller_method = substr($controller_method, 0, $posMethod);
		}

		return array($controller_name, $controller_method);
	}

	static function initModel($name){
		$name = 'model_'.$name;
		$path = 'app/models/';
		$file = strtolower($name).'.php';
		$path = $path.$file;
		if (file_exists($path)){
			include $path;
		}
	}

	static function initController($name){

		$name = 'controller_'.$name;
		$path = 'app/controllers/';
		$file = strtolower($name).'.php';
		$path = $path.$file;
		if (file_exists($path)){
			include $path;
		}
		else {
			ROUTE::ErrorPage404();
		}
	}

	static function initMethod($controller_name, $controller_method){
		$controller_name = "Controller_".$controller_name;
		$controller = new $controller_name;

		if (method_exists($controller, $controller_method)){
			$controller->$controller_method();
		}
		else {
			ROUTE::ErrorPage404();
		}
	}

	static function checkXSS(){
		if (!empty($_POST)){
			$array = $_POST;
		}
		elseif (!empty($_GET)){
			$array = $_GET;
		}
		else{
			return ;
		}
		$patternScript = "<script";
		foreach ($array as $dataForCheck){
			if (strpos($dataForCheck, $patternScript)){
				echo "<script>alert('Do you want to fuck my ass?')</script>";
				exit();
			}
		}
	}

	static function ErrorPage404(){
		echo("NOT FOUND 404");
		exit();
	}

}

?>
