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

	function checkEmailExist($email){
		$this->user = $this->getUserWithEmail($email);
		if ($this->user['email'] == $email){
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

	function sendMail($email, $login){

		$to      = $email;
		$subject = 'Activation Camaguru';
		$message = "Welcome " . $login ."!
			Thank you for joining Camaguru.
			To activate your account, please click the link below.
		";
		$headers = 'From: webmaster@example.com';
		mail($to, $subject, $message, $headers);
	}

	function addUser($email, $login, $pass){
		$token = md5($email.time());
		$pass = hash('Whirlpool', trim($pass));

		$conn = $this->connectToDB();
		$sql = "INSERT INTO users (login, email, pass, token) VALUES ('{$login}', '{$email}', '{$pass}', '{$token}');";
		try{
			$conn->exec($sql);
		}
		catch (PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
			die();
		}
		$conn = null;
		return $token;
	}

}

?>
