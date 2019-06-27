<?php

class Controller_gallery extends Controller{

	function __construct(){
		parent::__construct();
		$this->model = new Model_gallery();
	}

	function index(){

		$amountPhotos = $this->model->countImages();
		if ($amountPhotos == 0){
			$data = array("photos" => '');
			$this->view->render('view_gallery.php', $this->view->template_view, $data);
		}
		if (isset($_GET["page"])){
			$page = $_GET["page"];
		}
		else{
			$page = 1;
		}
		$pages = $amountPhotos / 5;
		$pages += $amountPhotos % 5 == 0 ? 0 : 1;
		$currUserId = $this->model->id;

		$photos = $this->model->getImages($page);
		$comments = $this->model->getComments();
		$data = array("photos" => $photos, "comments" => $comments, "pages" => $pages, "currUserId" => $currUserId);

		$this->view->render('view_gallery.php', $this->view->template_view, $data);
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
		$this->model->sendNotification($id, $comment);
		echo $author;
	}
}

?>
