<?php
class Controller {

	public $model;
	public $view;
	public $logged;

	function __construct(){
		$this->view = new View();
		session_start();
		if ($_SESSION['loggued_on_user']){
			$this->logged = $_SESSION['loggued_on_user'];
		}
		else {
			$this->logged = '';
		}
	}

}

?>
