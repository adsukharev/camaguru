<?php

class Controller_profile extends Controller
{
	function __construct(){
		parent::__construct();
		$this->model = new Model_profile();
	}

	function index(){
		$token = $this->model->createCRSF();
		$this->view->render('view_profile.php', $this->view->template_view, $token);

	}

	function modify(){
		$this->model->checkCRSF();
		$this->model->modify();
		$this->index();
	}

}

?>
