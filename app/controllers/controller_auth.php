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
		$email = $_POST['email'];
		$login = $_POST['login'];
		$pass  = $_POST['pass'];

		if ($this->model->checkEmailExist($email)){
			echo "Email has already singed up";
			exit();
		}
		if ($this->model->checkUserExist($login)){
			echo "User has already singed up";
			exit();
		}
		$token = $this->model->addUser($email, $login, $pass);
		$this->model->sendMail($email, $login, $token);
		echo ($login.", go to your email:" . $email . "and activate your account, please");
//		$this->view->render('view_main.php', $this->view->template_view);
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

	function signOut(){
		$this->model->signOut();
		$this->index();
	}

	function forgotPass(){
		$email = $_POST['email'];
	}

}

?>
