<?php

class Model {

	public $user;
	public $id;

	function connectToDB(){
		$DB_SERVER = "127.0.0.1";
		$DB_USER = "root";
		$DB_PASSWORD = "root";
		$DB_NAME = "camaguruDB";
		$DB_DSN = "mysql:host=$DB_SERVER;dbname=$DB_NAME";
		$OPTIONS = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		];
		try {
			$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $OPTIONS);
			return $conn;
		}
		catch(PDOException $e){
			echo "<br>" . $e->getMessage();
			exit();
		}

	}
	function getUsers(){

		$sql = "SELECT * FROM users;";
		try{
			$conn = $this->connectToDB();
			$sth = $conn->prepare($sql);
			$sth->execute();
			$users = $sth->fetchAll();
		}
		catch (PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
			die();
		}

		$conn = null;
		return ($users);
	}

	function getUser($login){

		$sql = "SELECT * FROM users WHERE login = '{$login}';";
		try{
			$conn = $this->connectToDB();
			$sth = $conn->prepare($sql);
			$sth->execute();
			$user = $sth->fetch();
		}
		catch (PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
			die();
		}
		$conn = null;
		return ($user);
	}

	function getUserWithEmail($email){

		$sql = "SELECT * FROM users WHERE email = '{$email}';";
		try{
			$conn = $this->connectToDB();
			$sth = $conn->prepare($sql);
			$sth->execute();
			$user = $sth->fetch();
		}
		catch (PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
			die();
		}
		$conn = null;
		return ($user);
	}

	function deleteImage($path){

		$sql = "DELETE FROM `photos` WHERE path =?;";
		try{
			$conn = $this->connectToDB();
			$sth = $conn->prepare($sql);
			$sth->execute([$path]);
			$conn = null;
			unlink($path);

		}
		catch (PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
			die();
		}
		$conn = null;
	}

	function createCRSF(){
		$secret = mt_rand(100, 1000);
		$_SESSION["csrf"] = $secret;
		$salt = mt_rand(100, 1000);
		$token = $salt . ":" . MD5($salt . ":" . $secret);
		setcookie("csrf", $token, time() + (86400 * 30), '/');
		return $token;

	}

	function checkCRSF(){
		$secret = $_SESSION["csrf"];
		$userToken = $_POST['csrf'];
		$posSalt = strpos($userToken, ':');
		$salt = substr($userToken, 0, $posSalt);

		$myToken = $salt . ":" . MD5($salt . ":" . $secret);
		if ($myToken != $userToken){
			echo "<script>alert('Do you want to fuck my ass?')</script>";
			exit();
		}

	}

}

?>
