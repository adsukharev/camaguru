<?php

class Model_main extends Model {

	public $filenameDate;
	public $target_dir = "images/users_images/";
	public $target_file;
	private $file_download;
	private $format;

	function __construct(){

		$this->user = $_SESSION['loggued_on_user'];
		$this->id= $this->getUser($this->user)['id'];

		$this->filenameDate = date('Y-m-d H:i:s');
		$this->target_file = $this->target_dir . $this->filenameDate.".png";

	}

	function mergePhotos(){

		try{
			$overlay = imagecreatefromjpeg('images/frames/vietnam.jpg');
			if ($this->format == 'png'){
				$image = imagecreatefrompng($this->file_download);
			}
			else {
				$image = imagecreatefromjpeg($this->file_download);
			}

			$size = getimagesize($this->file_download);

			imagealphablending($overlay, false);
			imagesavealpha($overlay, true);
			imagecopyresampled($overlay, $overlay,0,0,0,0,$size[0], $size[1], $size[0], $size[1]);
			imagecopymerge( $image, $overlay, 0, 0, 0, 0, $size[0], $size[1], 50);
//			imagecopy( $image, $overlay, 70, 20, 20, 0, $size[0], $size[1]);

			imagepng($image, $this->target_file);
			imagedestroy($image);
			imagedestroy($overlay);
//
//			TO DO: add this line in production
//			unlink($this->file_download);

		}
		catch(Exception $e) {
		   echo $e->getMessage();
		}

	}

	function downloadPhoto(){
		$target_dir_download = "images/tmp_download/";
		$filename = basename($_FILES["photo"]["name"]);
		$filename_array = explode(".", $filename);
		if ($filename_array[0] == "blob"){
			$this->format = "png";
		}
		else{
			$this->format = $filename_array[1];
		}
//		print_r($filename_array);
		$this->file_download = $target_dir_download . $this->filenameDate . "." .$this->format;
		if (move_uploaded_file($_FILES["photo"]["tmp_name"], $this->file_download)) {
			return 1;

		} else {
			echo "Sorry, there was an error uploading your file.";
			return 0;
		}
	}

	function sendPhoto(){
		$imageData = base64_encode(file_get_contents($this->target_file));
		echo ($imageData);
	}

	function addPhoto(){

		$conn = $this->connectToDB();

		$sql = "insert into photos (path, creation_date, user_id) values ('{$this->target_file}', '{$this->filenameDate}', '{$this->id}');";
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
