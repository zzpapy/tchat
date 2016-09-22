<?php
class CommentManager
	
{
	private $db;
	public function __construct($db)
	{
		$this->db = $db;
	}

	public function findAll()
	{
		$list=[];
		$query = "SELECT * FROM message";
		$res = mysqli_query($this->db, $query);
		while ($comment = mysqli_fetch_object($res, "Message", [$this->db]))
			$list[] = $comment;
		return $list;
	}
	public function findById($id)
	{
		$id = intval($id);
		$query = "SELECT * FROM comment WHERE id='".$id."'";
		$res = mysqli_query($this->db, $query);
		$comment = mysqli_fetch_object($res, "Comment", [$this->db]);
		return $comment;
	}
	// public function find($id)
	// {
	// 	return $this->findById($id);
	// }
	
	public function findByAuthor(User $author)
	{
		$list=[];
		$query = "SELECT * FROM message  WHERE id_author='".$author->getId()."'";
		$res = mysqli_query($this->db, $query);
		while ($user = mysqli_fetch_object($res, "Message", [$this->db]))
			$list[] = $user;
		return $list;
	}

	

	public function create ($content,$id_author)
	{
		$message = new Message($this->db);		
		$message->setContent($content);
		$message-> setIdAuthor($id_author);
		
		$date = mysqli_real_escape_string($this->db, $message->getDate());
		$content = mysqli_real_escape_string($this->db, $message-> getContent());
		$query = "INSERT INTO message ( content,id_author ) 
		VALUES('".$content."', '".$id_author."')";
		mysqli_query($this->db, $query);
		$id_comment = mysqli_insert_id($this->db);
		return $this->findById($id_comment);
	}
}
?>