<?php

class Controller_main extends Controller{

	function index(){
		if ($this->logged)
			$this->view->render('view_main.php', $this->view->template_view);
		else{
			$this->view->render('view_auth.php', $this->view->template_view);

		}
	}
}

?>
