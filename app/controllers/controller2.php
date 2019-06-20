<?php

class Controller_auth extends Controller{

	function index(){
		$this->view->render('view_auth.php', $this->view->template_view);
	}
	function
	function main(){
		$this->view->render('view_main.php', $this->view->template_view);
	}
	function profile(){
		$this->view->render('view_profile.php', $this->view->template_view);
	}
}

?>
