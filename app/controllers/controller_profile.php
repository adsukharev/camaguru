<?php

class Controller_profile extends Controller{

	function index(){
		$this->view->render('view_auth.php', $this->view->template_view);
	}
}

?>
