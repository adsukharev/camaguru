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
		$data = $_POST;
		if ($this->model->checkUserExist($data['login'])){
			$this->model->addUser($data);
			$this->view->render('view_main.php', $this->view->template_view);
		}
		else {
			echo "User has already singed up";
		}
	}

	function signIn($data){
		if ($this->model->checkUserExist($data['login'])){
			if ($this->model->checkLoginPass($data['pass'])){
				$this->view->render('view_main.php', $this->view->template_view);
			}
			else {
				echo "Password is invalid";
			}
		}
		else {
			echo "User does not exist";
		}
	}

}

?>
