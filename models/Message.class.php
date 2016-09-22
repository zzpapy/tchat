<?php 
// Définition de la classe Article
class Message
{
	
	// Propriétés
	private $id  ;
	private $date  ;
	private $content;
	private $id_author ;
	private $author ;
	private $db;
	
	public function __construct($db)
	{
		$this->db = $db;
	}

	// Méthodes
	// Liste des getters
	public function getId()
	{
		return $this->id;
	}
	public function getDate()
	{
		return $this->date;
	}
	public function getContent()
	{
		return $this->content;
	}
	
	
	public function getAuthor()
	{
		// Si l'auteur n'a pas encore été récupéré ou n'est pas connu
		if (!$this->author)
		{
			// Il faut donc aller le chercher !
			// On récupère le manager qui va bien (ici, UserManager)
			$manager = new UserManager($this->db);
			// Et on lui demande d'aller chercher l'User qui correspond à id_author
			$this->author = $manager->findById($this->id_author);
		}
		// On peut du coup retourner $this->author
		return $this->author;
	}

	// Liste des setters
	public function setAuthor(User $author)
	{
		$this->author = $author;
		$this->id_author = $author->getId();
	}
	
	public function setDate($date)
	{
		
			$this->date = $date;
	}
	public function setContent($content)
	{
		
			$this->content = $content;
	}
	// public function setIdCaddy($id_caddy)
	// {
	// 	$this->id_caddy = $id_caddy;
	// }
	


	
}

?>