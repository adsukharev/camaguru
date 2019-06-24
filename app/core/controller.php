<?php
class Controller {

	public $model;
	public $view;
	public $logged;

	function __construct(){
		$this->view = new View();
		session_start();
		if (array_key_exists('loggued_on_user', $_SESSION)){
			$this->logged = $_SESSION['loggued_on_user'];
		}
		else {
			$this->logged = '';
		}
	}

}

?>
