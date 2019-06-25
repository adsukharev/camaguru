<?php

class Model_gallery extends Model {

	function __construct(){

		$this->user = $_SESSION['loggued_on_user'];
		$this->id= $this->getUser($this->user)['id'];

	}

	function getImages(){
		$conn = $this->connectToDB();
		$sql = "SELECT id, path, likes, user_id
		FROM photos
		ORDER BY creation_date DESC;";
		$sth = $conn->prepare($sql);
		$sth->execute();
		$photos = $sth->fetchAll();
//		$arrayPhoto = $this->makeArrImages($photos);
		$conn = null;
		return (array($photos, $this->id));
	}

	function getComments(){

		$conn = $this->connectToDB();
		$sql = "SELECT author, comment, photo_id
		FROM comments
		ORDER BY photo_id ASC;";
		$sth = $conn->prepare($sql);
		$sth->execute();
		$comments = $sth->fetchAll();
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
		}
	}

//		UPDATE photos SET likes = 3 WHERE id = 38;
//		INSERT INTO comments (author, comment, creation_date, photo_id) VALUES ('root', 'test comment 2', '2019-06-25 09:50:17', '38');"
//

//		$sql = "SELECT photos.path, photos.likes, photos.user_id, comments.author, comments.comment
//		FROM photos
//		LEFT OUTER JOIN comments ON photos.id = comments.photo_id
//		ORDER BY photos.creation_date DESC;";

//	protected function makeArrImages($data){
//
//		$arrayPhoto = array();
//		foreach ($data as  $arrData){
//			foreach ($arrData as $photo){
//				array_push($arrayPhoto,$photo);
//			}
//		}
//		return $arrayPhoto;
//	}

}
?>
