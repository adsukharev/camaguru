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

	function checkAuthorized($login){
		$this->user = $this->getUser($login);
		return ($this->user['status']);
	}

	function checkLoginPassAuth($data){
		$login = $data['login'];
		$pass = hash('Whirlpool', trim($data['pass']));

		if (!$this->checkAuthorized($login)){
			return ("You are now authorized. Check your email, please");
		}
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

	function sendMail($email, $login, $token){

		$to      = $email;
		$subject = 'Activation Camaguru';
		$message =
			"<html>
				<head>
				  <title>Activation</title>
				</head>
				
				<body>
					Welcome $login!
					<br>
					Thank you for joining Camaguru.
					<br>
					To activate your account, please click the link below.
					<br>
					<a href='http://localhost/auth/activateAccount?activate=$token&login=$login'>Activate</a>
				</body>
			</html>";


		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-type: text/html; charset=iso-8859-1';
		 mail($to, $subject, $message, implode("\r\n", $headers));

	}

	function addUser($email, $login, $pass){
		$token = md5($email.time());
		$pass = hash('Whirlpool', trim($pass));

		$sql = "INSERT INTO users (login, email, pass, token) VALUES ('{$login}', '{$email}', '{$pass}', '{$token}');";
		try{
			$conn = $this->connectToDB();
			$conn->exec($sql);
		}
		catch (PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
			die();
		}
		$conn = null;
		return $token;
	}

	function checkToken($token, $login){
		$this->user = $this->getUser($login);
		if ($token != $this->user['token']){
			echo "Wrong token!";
			exit();
		};
		return 1;
	}

	function activateUser(){
		$sql = "UPDATE users SET status = 1 WHERE id = '{$this->user['id']}';";
		try{
			$conn = $this->connectToDB();
			$conn->exec($sql);
		}
		catch (PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
			die();
		}
		$conn = null;
	}

}

?>
