<?php

class Controller_main extends Controller{

	function index(){
		$this->view->render('view_auth.php', $this->view->template_view);
	}
}

?>
