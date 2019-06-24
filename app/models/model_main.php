<?php

class Model_main extends Model {

	function __construct(){

		$this->user = $_SESSION['loggued_on_user'];
		$this->id= $this->getUser($this->user)['id'];
	}

	function downloadPhoto(){
		$target_dir = "images/users_images/";
		$filename = date('Y-m-d H:i:s');
		$target_file = $target_dir . $filename;
//		var_dump($filename);
		if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
			$this->addPhoto($target_file, $filename);
			$this->sendPhoto($target_file);

		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}

	function sendPhoto($target_file){
		$imageData = base64_encode(file_get_contents($target_file));
//		$file = 'data:'.mime_content_type($target_file).';base64,'.$imageData;
		echo ($imageData);
	}

	function addPhoto($path, $date){

		$conn = $this->connectToDB();

		$sql = "insert into photos (path, creation_date, user_id) values ('{$path}', '{$date}', '{$this->id}');";
		try{
			$conn->exec($sql);
		}
		catch (PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
		}

		$conn = null;
	}

}

?>
