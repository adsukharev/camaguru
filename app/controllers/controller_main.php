<?php

class Controller_main extends Controller{

	function index(){
		$this->view->render('view_template.php', $this->view->template_view);
	}
}

?>
