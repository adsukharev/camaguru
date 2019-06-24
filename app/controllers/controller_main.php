<?php

class Controller_main extends Controller{

	function __construct(){
		parent::__construct();
		$this->model = new Model_main();
	}

	function index(){
		if ($this->logged)
			$this->view->render('view_main.php', $this->view->template_view);
		else{
			$this->view->render('view_auth.php', $this->view->template_view);

		}
	}

	function makeMagic(){
//		print_r($_POST);
//		print_r($_FILES);
		$this->model->downloadPhoto();
//		$this->view->render('view_main.php', $this->view->template_view);
	}
}

?>
