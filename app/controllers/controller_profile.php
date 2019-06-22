<?php

class Controller_profile extends Controller
{
//	function __construct(){
//		parent::__construct();
//	}

	function index(){
		if ($this->logged)
			$this->view->render('view_profile.php', $this->view->template_view);
		else {
			$this->view->render('view_auth.php', $this->view->template_view);
		}
	}

	function modify(){
		$this->model = new Model_profile();
		$this->model->modify();
		$this->index();
	}

}

?>
