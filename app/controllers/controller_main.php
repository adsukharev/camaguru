<?php

class Controller_main extends Controller{

	function __construct(){
		parent::__construct();
		$this->model = new Model_main();
	}

	function index(){
		$this->model->createCRSF();
		$this->view->render('view_main.php', $this->view->template_view);
	}

	function makeMagic(){
		$this->model->checkCRSF();
		$this->model->downloadPhoto();
		$this->model->mergePhotos();
		$this->model->addPhoto();
		$this->model->sendPhoto();

	}

	function deleteImage(){
		$this->model->checkCRSF();
		$path = $_POST["imageToDelete"];
		$this->model->deleteImage($path);
	}
}

?>
