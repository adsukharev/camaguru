<?php

class Controller_auth extends Controller{

	function __construct(){
		parent::__construct();
		$this->model = new Model_auth();
	}

	function index(){
		$this->view->render('view_auth.php', $this->view->template_view);
	}

	function signUp(){
		if ($this->model->checkUserExist($_POST['login'])){
			echo "User has already singed up";
		}
		else {
			$this->model->addUser($_POST);
			$this->view->render('view_main.php', $this->view->template_view);
		}
	}

	function signIn(){
		$check = $this->model->checkLoginPass($_POST);
		if ($check == 1){
			$this->view->render('view_main.php', $this->view->template_view);
		}
		else {
			echo $check;
		}
	}

}

?>
