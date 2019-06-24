<?php

class Model_main extends Model {

	function downloadPhoto(){
		$target_dir = "images/users_images/";
		$target_file = $target_dir . basename($_FILES["photo"]["name"]);
		if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
			$this->sendPhoto($target_file);

		} else {
			print_r($_FILES);
//			echo "Sorry, there was an error uploading your file.";
		}
	}

	function sendPhoto($target_file){
		$imageData = base64_encode(file_get_contents($target_file));
//		$file = 'data:'.mime_content_type($target_file).';base64,'.$imageData;
		echo ($imageData);
	}

}

?>
