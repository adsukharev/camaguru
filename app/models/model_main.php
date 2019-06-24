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
			$meme = "vietnam";
//			init images
			$imagesArr = $this->imagesInit($meme);
			$image = $imagesArr[0];
			$overlay = $imagesArr[1];

//			change size of mem Image and delete white background
			$dest = imagescale($image, 250, 250);
			$srcArr = $this->resizeTransparentPhoto($overlay, $meme);
			$src = $srcArr[0];
			$sizeSrc = $srcArr[1];
			$opacity = $srcArr[2];

//			merge
			if ($meme == "life")
				imagecopymerge($dest, $src, 50, 50, 0, 0, $sizeSrc, $sizeSrc, $opacity);
			else
				imagecopymerge($dest, $src, 0, 0, 0, 0, $sizeSrc, $sizeSrc, $opacity);

//			save new image
			imagepng($dest, $this->target_file);

//			deleteImages
			imagedestroy($image);
			imagedestroy($overlay);
			imagedestroy($src);
			imagedestroy($dest);

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
		else {
			$this->format = $filename_array[1];
		}
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

	protected function resizeTransparentPhoto($overlay, $meme){


		if ($meme == "vietnam"){
			$size = 250;
			$opacity = 40;
		}
		elseif ($meme == "dog"){
			$size = 150;
			$opacity = 100;
		}
		else{
			$size = 150;
			$opacity = 100;
		}
		$src = imagescale($overlay, $size, $size);
		if ($meme != "vietnam"){
			$black = imagecolorallocate($src, 255, 255, 255);
			imagecolortransparent($src, $black);
		}
		return array($src, $size, $opacity);
	}

	protected function imagesInit($meme){

		if ($meme == "cat"){
			$overlay = imagecreatefromjpeg('images/frames/'.$meme.'.jpeg');
		}
		else {
			$overlay = imagecreatefromjpeg('images/frames/'.$meme.'.jpg');
		}

		if ($this->format == 'png'){
			$image = imagecreatefrompng($this->file_download);
		}
		else {
			$image = imagecreatefromjpeg($this->file_download);
		}

		return array($image, $overlay);
	}



}

?>
