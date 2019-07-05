<?php

class Model {

	public $user;
	public $id;

	function connectToDB(){
		include "config/database.php";
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

    function getAllImages()
    {
        $this->user = $_SESSION['loggued_on_user'];
        $this->id= $this->getUser($this->user)['id'];
        $sql = "SELECT id, path
		FROM photos
		WHERE user_id = '{$this->id}'
		ORDER BY creation_date ASC;";

        try {
            $conn = $this->connectToDB();
            $sth = $conn->prepare($sql);
            $sth->execute();
            $photos = $sth->fetchAll();
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
            die();
        }
        $conn = null;
        return ($photos);
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

	function createCSRF(){
		$secret = mt_rand(100, 1000);
		$_SESSION["csrf"] = $secret;
		$salt = mt_rand(100, 1000);
		$token = $salt . ":" . MD5($salt . ":" . $secret);
		setcookie("my_token", $token, time() + (86400 * 30), '/');
		return $token;
	}

	function checkCSRF(){
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

