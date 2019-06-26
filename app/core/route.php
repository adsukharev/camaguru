<?php

class Route {

	static function start() {
		$controller_array = ROUTE::getUri();
		$controller_name = $controller_array[0];
		$controller_method = $controller_array[1];
		ROUTE::initModel($controller_name);
		ROUTE::initController($controller_name);
		ROUTE::initMethod($controller_name, $controller_method);
	}

	function getUri(){
		$controller_name = 'main';
		$controller_method = 'index';
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		if (!empty($routes[1])){
			$controller_name = $routes[1];
		}
		if (!empty($routes[2])){
			$controller_method = $routes[2];
		}
		if (isset($_GET["page"])){
			$pos = strpos($controller_name, '?');
			$controller_name = substr($controller_name, 0, $pos);
		}
		return array($controller_name, $controller_method);
	}

	function initModel($name){
		$name = 'model_'.$name;
		$path = 'app/models/';
		$file = strtolower($name).'.php';
		$path = $path.$file;
		if (file_exists($path)){
			include $path;
		}
	}

	function initController($name){

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

	function initMethod($controller_name, $controller_method){
		$controller_name = "Controller_".$controller_name;
		$controller = new $controller_name;

		if (method_exists($controller, $controller_method)){
			$controller->$controller_method();
		}
		else {
			ROUTE::ErrorPage404();
		}
	}

	function ErrorPage404(){
		$host = 'http://'.$_SERVER['HTTP_HOST'];
		echo("NOT FOUND 404");
		exit();
	}

}

?>
