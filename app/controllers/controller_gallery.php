<?php

class Controller_gallery extends Controller{

	function __construct(){
		parent::__construct();
		$this->model = new Model_gallery();
	}

	function index(){

		$this->view->render('view_gallery.php', $this->view->template_view);
	}

	function deleteImage(){

		$path = $_POST["imageToDelete"];
		$res = $this->model->deleteImage($path);
		echo $res;
	}
}

?>
