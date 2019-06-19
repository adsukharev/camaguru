<?php

class Controller_post extends Controller{

	function index(){
		$this->view->render('view_template.php', $this->view->template_view);
	}
}

?>
