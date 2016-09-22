<?php
	class UserManager
	{
		private $tchat;
		public function __construct($tchat)
		{
			$this->tchat = $tchat;
		}

		public function findAll()
		{
			$query = "SELECT * FROM user";
			$res = mysqli_query($this->tchat, $query);
			while ($user = mysqli_fetch_object($res, "User", [$this->tchat]))
				$list[] = $user;
			return $list;
		}
		public function findById($id)
		{
			$id = intval($id);
			$query = "SELECT * FROM user WHERE id='".$id."'";
			$res = mysqli_query($this->tchat, $query);
			$user = mysqli_fetch_object($res, "User", [$this->tchat]);
			return $user;
		}
		

		public function findByLogin($login)
		{
			$login = mysqli_real_escape_string($this->tchat, $login);
			$query = "SELECT * FROM user WHERE login='".$login."'";
			$res = mysqli_query($this->tchat, $query);
			$user = mysqli_fetch_object($res, "User", [$this->tchat]);
			
			return $user;
		}

		public function create ($password, $login)
		{
			$user = new User($this->tchat);
			$user-> setLogin($login);
			$user-> setPassword($password);
			

			$mail = mysqli_real_escape_string($this->tchat, $user->getLogin());			
			$password = mysqli_real_escape_string($this->tchat, $user->getPassword());
			
			
			$query = "INSERT INTO user (password,login) 
			VALUES('".$password."',  '".$login."')";
			mysqli_query($this->tchat, $query);
			
			

			if (mysqli_errno($this->tcaht) == 1062){
				throw new Exception("error");
			}
			$id_user = mysqli_insert_id($this->tcaht);
			return $this->findById($id_user);
		}
	}
?>				