<?php

class Model_gallery extends Model {

	function __construct(){

		$this->user = $_SESSION['loggued_on_user'];
		$this->id= $this->getUser($this->user)['id'];

	}





}

?>
