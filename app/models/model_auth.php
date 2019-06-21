<?php

class Model_auth extends Model {

	function __construct(){
		$this->users = $this->getUsers();
	}

	function checkUserExist($login){
		if (array_key_exists($login, $this->users)){
			return 1;
		}
		return 0;
	}

	function checkLoginPass($data){
		$login = $data['login'];
		$pass = $data['pass'];
		if ($this->checkUserExist($login)){
			if ($this->users[$login] == $pass){
				return 1;
			}
			else {
				return ("Password is invalid");
			}
		}
		else {
			return ("User does not exist");
		}

	}


	function addUser($data){
		return 1;
	}

}

?>
