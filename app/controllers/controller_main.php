<?php

class Controller_main extends Controller{

	function __construct(){
		parent::__construct();
		$this->model = new Model_main();
	}

	function index(){
		if ($this->logged)
			$this->view->render('view_main.php', $this->view->template_view);
		else{
			$this->view->render('view_auth.php', $this->view->template_view);

		}
	}

	function makeMagic(){

		$this->model->downloadPhoto();
		$this->model->mergePhotos();
		//			TO DO: add this line in production
		$this->model->addPhoto();
		$this->model->sendPhoto();

	}

	function deleteImage(){

		$path = $_POST["imageToDelete"];
		$res = $this->model->deleteImage($path);
		echo $res;

	}
}

?>
