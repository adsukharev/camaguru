<?php

class Controller_Main extends Controller{

	function index(){
		$this->view->render('view_template.php', 'view_template.php');
	}
}

?>
