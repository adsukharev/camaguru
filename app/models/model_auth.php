<?php

class Model_auth extends Model {

	function __construct(){
		$this->users = $this->getUsers();
	}

	function checkUserExist($login){
		if (!array_key_exists($login, $this->users)){
			return 1;
		}
		return 0;
	}

	function checkLoginPass($pass){
		if (array_key_exists($pass, $this->users)){
			return 1;
		}
		return 0;
	}


	function addUser($data){
		return 1;
	}

}

?>
