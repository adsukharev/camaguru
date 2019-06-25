<?php

class Controller_gallery extends Controller{

	function __construct(){
		parent::__construct();
		$this->model = new Model_gallery();
	}

	function index(){

		$imagesUserId = $this->model->getImages();
		if ($imagesUserId[0]){
			$comments = $this->model->getComments();
			array_push($imagesUserId, $comments);
		}
		else {
			$imagesUserId[0] = "0";
			$imagesUserId[2] = "0";
		}
		$this->view->render('view_gallery.php', $this->view->template_view, $imagesUserId);
	}

	function deleteImage(){

		$path = $_POST["imageToDelete"];
		$res = $this->model->deleteImage($path);
		echo $res;
	}

	function incLikes(){
		$id = (int)$_POST['id'];
		$like = (int)$_POST['like'] + 1;
		$this->model->incLike($id, $like);
	}

	function addComment(){
		$id = (int)$_POST['id'];
		$comment = $_POST['comment'];
		$author = $this->model->addComment($id, $comment);
		echo $author;
	}
}

?>
