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
			echo "Email has already signed up";
			exit();
		}
		if ($this->model->checkUserExist($login)){
			echo "User has already signed up";
			exit();
		}
		$token = $this->model->addUser($email, $login, $pass);
		$this->model->sendMailToken($email, $login, $token);

		echo ($login.", check email: " . $email . " to activate your account, please");
	}

	function activateAccount(){
		if (!isset($_GET['activate'])){
			echo "What the hell! Where is value from activate?!";
			exit();
		}
		$token = $_GET['activate'];
		$login = $_GET['login'];
		$this->model->checkToken($token, $login);
		$this->model->activateUser();
		echo "Activated. Sign in please. <a href='/main'>Camaguru</a>";
	}

	function signIn(){
		$check = $this->model->checkLoginPassAuth($_POST);
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
		if (!$this->model->checkEmailExist($email)){
			echo "Email does not signed up";
			exit();
		}
		$newPass = $this->model->createNewPass();
		$this->model->sendMailForgotPassword($newPass);
		echo "Check email: $email";
	}

}

?>
