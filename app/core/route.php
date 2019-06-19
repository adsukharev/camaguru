<?php

class Route {

	static function start() {

		$controller_name = 'Main';
		$controller_method = 'index';
		$controller_path = "app/controllers/";

		$model_name = '';
		$model_file = '';
		$model_path = "app/models/";

		$routes = explode('/', $_SERVER['REQUEST_URI']);

		if (!empty($routes[1])){
			$controller_name = $routes[1];
		}

		if (!empty($routes[2])){
			$controller_method = $routes[2];
		}

		$model_name = 'Model_'.$model_name;
		$controller_name = 'Controller_'.$controller_name;

		$model_file = strtolower($model_name).'.php';
		$model_path = $model_path.$model_file;
		// if (file_exists($model_path)){
		// 	include $model_path;
		// }
		// else {
		// 	ErrorPage404();
		// }

		$controller_file = strtolower($controller_name).'.php';
		$controller_path = $controller_path.$controller_file;
		if(file_exists($controller_path))
		{
			include $controller_path;
		}
		else {
			ROUTE::ErrorPage404();
		}

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
		echo("404");
	}

}

?>
