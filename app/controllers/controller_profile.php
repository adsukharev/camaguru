<?php

class Controller_profile extends Controller
{
	function __construct(){
		parent::__construct();
		$this->model = new Model_profile();
	}

	function index(){
		$token = $this->model->createCSRF();
		$this->view->render('view_profile.php', $this->view->template_view, $token);

	}

	function modify(){
		$this->model->checkCSRF();
		$this->model->modify();
		$this->index();
	}

}

?>
