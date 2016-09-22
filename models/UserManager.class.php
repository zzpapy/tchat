<?php
	class UserManager
	{
		private $db;

		public function __construct($db)
		{
			$this->db = $db;
		}

		public function findAll()
		{
			$query = "SELECT * FROM user";
			$res = mysqli_query($this->db, $query);
			while ($user = mysqli_fetch_object($res, "User", [$this->db]))
				$list[] = $user;
			return $list;
		}

		public function findById($id)
		{
			$id = intval($id);
			$query = "SELECT * FROM user WHERE id='".$id."'";
			$res = mysqli_query($this->db, $query);
			$user = mysqli_fetch_object($res, "User", [$this->db]);
			return $user;
		}

		public function findByLogin($login)
		{
			$login = mysqli_real_escape_string($this->db, $login);
			$query = "SELECT * FROM user WHERE login='".$login."'";
			$res = mysqli_query($this->db, $query);
			$user = mysqli_fetch_object($res, "User", [$this->db]);
			
			return $user;
		}

		public function create ($password, $login)
		{
			$user = new User($this->db);
			$user-> setLogin($login);
			$user-> setPassword($password);

			$login = mysqli_real_escape_string($this->db, $user->getLogin());			

			$password = mysqli_real_escape_string($this->db, $user->getPassword());

			$query = "INSERT INTO user (password,login) 
			VALUES('".$password."',  '".$login."')";
			mysqli_query($this->db, $query);

			if (mysqli_errno($this->db) == 1062){
				throw new Exception("error");
			}
			$id_user = mysqli_insert_id($this->db);
			return $this->findById($id_user);
		}
	}
?>				