<?php

class Model_auth extends Model {

	function signOut(){
		$_SESSION['loggued_on_user'] = '';
	}

	function checkUserExist($login){
		$this->user = $this->getUser($login);
		if ($this->user['login'] == $login){
			return 1;
		}
		return 0;
	}

	function checkLoginPass($data){
		$login = $data['login'];
		$pass = hash('Whirlpool', trim($data['pass']));

		if ($this->checkUserExist($login)){
			if ($this->user['pass'] == $pass){
				$_SESSION['loggued_on_user'] = $login;
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
		$email = $data['email'];
		$login = $data['login'];
		$pass = hash('Whirlpool', trim($data['pass']));
		$conn = $this->connectToDB();
		$sql = "INSERT INTO users (login, email, pass) VALUES ('{$login}', '{$email}', '{$pass}');";
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
