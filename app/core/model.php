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
		$conn = null;
		return ($user);
	}

	function deleteImage($path){

		try{
			$conn = $this->connectToDB();
			$sql = "DELETE FROM `photos` WHERE path = '{$path}';";
			$conn->exec($sql);
			$conn = null;
			unlink($path);
			return 1;
		}
		catch (Exception $e){
			$conn = null;
			return 0;
		}

	}



}

?>
