<?php

class Model_gallery extends Model {

	function __construct(){

		$this->user = $_SESSION['loggued_on_user'];
		$this->id= $this->getUser($this->user)['id'];

	}

	function countImages(){
		$sql = "SELECT COUNT(*)
		FROM photos;";
		try {
			$conn = $this->connectToDB();
			$sth = $conn->prepare($sql);
			$sth->execute();
			$amountPhotos = $sth->fetch()['COUNT(*)'];
		}
		catch (PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
			die();
		}
		$conn = null;
		return ($amountPhotos);
	}

	function getImages($page){

		$until = $page * 5;
		$from = $until - 5;
		$sql = "SELECT id, path, likes, user_id
		FROM photos
		ORDER BY creation_date DESC
		LIMIT {$from}, {$until};";

		try{
			$conn = $this->connectToDB();
			$sth = $conn->prepare($sql);
			$sth->execute();
			$photos = $sth->fetchAll();
		}
		catch (PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
			die();
		}
		$conn = null;
		return ($photos);
	}

	function getComments(){

		$sql = "SELECT author, comment, photo_id
		FROM comments
		ORDER BY photo_id ASC;";
		try{
			$conn = $this->connectToDB();
			$sth = $conn->prepare($sql);
			$sth->execute();
			$comments = $sth->fetchAll();
		}
		catch (PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
			die();
		}
		$conn = null;
		return $comments;
	}

	function incLike($id, $like){

		$sql = "UPDATE photos
 				SET likes = '{$like}' WHERE id = '{$id}';";
		try {
			$conn = $this->connectToDB();
			$conn->exec($sql);
		}
		catch (PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
			die();
		}
	}

	function addComment($id, $comment){
		$date = date('Y-m-d H:i:s');
		$sql = "INSERT INTO comments (author, comment, creation_date, photo_id)
 				VALUES ('{$this->user}', '{$comment}', '{$date}', '{$id}');";
		try{
			$conn = $this->connectToDB();
			$conn->exec($sql);
		}
		catch (PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
			die();
		}
		$conn = null;
		return $this->user;
	}
}

?>
