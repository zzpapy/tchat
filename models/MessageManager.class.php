<?php
class CommentManager
	
{
	private $tchat;
	public function __construct($tchat)
	{
		$this->tchat = $tchat;
	}

	public function findAll()
	{
		$list=[];
		$query = "SELECT * FROM message";
		$res = mysqli_query($this->tchat, $query);
		while ($comment = mysqli_fetch_object($res, "Message", [$this->tchat]))
			$list[] = $comment;
		return $list;
	}
	public function findById($id)
	{
		$id = intval($id);
		$query = "SELECT * FROM comment WHERE id='".$id."'";
		$res = mysqli_query($this->tchat, $query);
		$comment = mysqli_fetch_object($res, "Comment", [$this->tchat]);
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
		$res = mysqli_query($this->tchat, $query);
		while ($user = mysqli_fetch_object($res, "Message", [$this->tchat]))
			$list[] = $user;
		return $list;
	}

	

	public function create ($content,$id_author)
	{
		$message = new Message($this->tchat);		
		$message->setContent($content);
		$message-> setIdAuthor($id_author);
		
		$date = mysqli_real_escape_string($this->tchat, $message->getDate());
		$content = mysqli_real_escape_string($this->tchat, $message-> getContent());
		$query = "INSERT INTO message ( content,id_author ) 
		VALUES('".$content."', '".$id_author."')";
		mysqli_query($this->tchat, $query);
		$id_comment = mysqli_insert_id($this->tchat);
		return $this->findById($id_comment);
	}
}
?>