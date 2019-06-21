<?php

class Model {

	public $user;

	function connectToDB(){
		$DB_SERVER = "127.0.0.1"; // локалхост
		$DB_USER = "root"; // имя пользователя
		$DB_PASSWORD = "root"; // пароль если существует
		$DB_NAME = "camaguruDB"; // база данных
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

		$conn = $this->connectToDB();
		$sql = "SELECT * FROM users;";
		$sth = $conn->prepare($sql);
		$sth->execute();
		$users = $sth->fetchAll();

		$conn = null;
		return ($users);
	}

	function getUser($login){

		$conn = $this->connectToDB();
		$sql = "SELECT * FROM users WHERE login = '{$login}';";
		$sth = $conn->prepare($sql);
		$sth->execute();
		$user = $sth->fetch();
		print_r($user);
		$conn = null;
		return ($user);
	}


}

?>
