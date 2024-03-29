<?php

class Model_profile extends Model {

	public $id;
	public $login;
	public $email;
	public $pass;
	public $notification = 0;

	function __construct(){
		$this->user = $this->getUser($_SESSION['loggued_on_user']);
		$this->id = $this->user['id'];
		$this->email = $_POST['email'];
		$this->login = $_POST['login'];
		if (array_key_exists('notification', $_POST)){
			$this->notification = 1;
		}

		if ($_POST['pass'])
			$this->pass = hash('Whirlpool', trim($_POST['pass']));
	}

	function modify(){
		$conn = $this->connectToDB();
		if ($this->email){
			$this->modifyEmail($conn);
		}
		if ($this->login){
			$this->modifyLogin($conn);
		}
		if ($this->pass){
			$this->modifyPass($conn);
		}
		$this->modifyNotification($conn);
		$conn = null;
	}

	private function modifyEmail($conn){
			$sql = "UPDATE users SET email =? WHERE id =?;";
			try{
				$stmt= $conn->prepare($sql);
				$stmt->execute([$this->email, $this->id]);
			}
			catch (PDOException $e){
				echo $sql . "<br>" . $e->getMessage();
				die();
			}

	}

	private function modifyLogin($conn){
		$sql = "UPDATE users SET login =? WHERE id =?;";
		try{
			$stmt= $conn->prepare($sql);
			$stmt->execute([$this->login, $this->id]);
			$_SESSION['loggued_on_user'] = $this->login;
		}
		catch (PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
			die();
		}

	}

	private function modifyPass($conn){
		$sql = "UPDATE users SET pass =? WHERE id =?;";
		try{
			$stmt= $conn->prepare($sql);
			$stmt->execute([$this->pass, $this->id]);
		}
		catch (PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
			die();
		}

	}

	private function modifyNotification($conn){
		$sql = "UPDATE users SET notification =? WHERE id =?;";
		try{
			$stmt= $conn->prepare($sql);
			$stmt->execute([$this->notification, $this->id]);
		}
		catch (PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
			die();
		}

	}

}

?>
