<?php 
// Définition de la classe Article
	class User
	{

		// Propriétés
		private $id;
		private $login;
		private $password;
		private $date;
		private $db;
		

		public function __construct($db)
		{
			$this->db = $db;
		}
// Méthodes
// GETTERS

		public function getComments()
		{
			if (!$this->comments)
			{
				$manager = new CommentManager($this->db);
				$this->comments = $manager->findByAuthor($this);
			}
			return $this->comments;
		}
		
		public function getId()
		{
			return $this->id;
		}
		public function getLogin()
		{
			return $this->login;
		}
		public function getPassword()
		{
			return $this->password;
		}
		public function getDate()
		{
			return $this->date;
		}
		public function verifPassword($password)
		{
			return password_verify($password, $this->password);
		}


// SETTERS
		public function setLogin($login)
		{
			if(empty($login)){
				throw new Exception("Veuillez renseigner un nom");
			}
			// else if(strlen($login) < 3 || strlen($login) > 63){
			// 	throw new Exception("Nom trop court");
			// }
			else{
				$this->login = $login;
			}
		}
		
		public function setPassword($password)
		{
			//conditions de verification de password
			if(empty($password)){
				throw new Exception("Merci de remplir tout les champs");
			}
			else if(strlen($password) < 3){
				throw new Exception("Le mot de passe est trop court");
			}
			else{
				$this->password = password_hash($password, PASSWORD_DEFAULT);
			}
		}
		

// Liste des fonctions spécifiques
// Ici vide
	}
?>