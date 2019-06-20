<?php

class Route {

	static function start() {
		$controller_array = ROUTE::getUri();
		$controller_name = $controller_array[0];
		$controller_method = $controller_array[1];
		if ($controller_method != 'index')
			ROUTE::initModelController($controller_name, "model");
		ROUTE::initModelController($controller_name, "controller");
		ROUTE::initMethod($controller_name, $controller_method);
	}

	function getUri(){
		$controller_name = 'auth';
		$controller_method = 'index';
		print_r($_SERVER['REQUEST_URI']);
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		if (!empty($routes[1])){
			$controller_name = $routes[1];
		}
		if (!empty($routes[2])){
			$controller_method = $routes[2];
		}
		return array($controller_name, $controller_method);
	}

	function initModelController($name, $model_controller){
		if ($model_controller == "model"){
			$name = 'model_'.$name;
			$path = 'app/models/';
		}
		else {
			$name = 'controller_'.$name;
			$path = 'app/controllers/';
		}
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

	// function initController($controller_name){
	// 	$controller_name = 'Controller_'.$controller_name;
	// 	$controller_file = strtolower($controller_name).'.php';
	// 	$controller_path = $controller_path.$controller_file;
	// 	if (file_exists($controller_path))
	// 	{
	// 		include $controller_path;
	// 	}
	// 	else {
	// 		ROUTE::ErrorPage404();
	// 	}
	// }
	// function handle_post($post){
	// 	print_r($post);
	// 	include "app/controllers/controller_auth.php";
	// 	$controller = new Controller_auth();
	// 	if (array_key_exists("SignUp", $post)){
	// 		$controller->signUp($post);
	// 	}
	// 	elseif (array_key_exists("SignIn", $post)){
	// 		$controller->signIn($post);
	// 	}
	// 	// include "app/views/view_template.php";
	// 	exit();
	// }

	function ErrorPage404(){
		$host = 'http://'.$_SERVER['HTTP_HOST'];
		echo("NOT FOUND 404");
		exit();
	}

}

?>
