<?php

class CommentModel extends Model implements IModel{

	private $id;
	private $comment;
	private $ticketId;
	private $userId;
	private $createdAt;

	public function __construct(){
		parent::__construct();
		$this->id=0;
		$this->comment='';
		$this->ticketId=0;
		$this->userId=0;
		$this->createdAt='';
	}

	public function setId($id){
		$this->id=$id;
	}
	
	public function getId(){
		return $this->id;
	}

	public function setComment($comment){
		$this->comment=$comment;
	}
	
	public function getComment(){
		return $this->comment;
	}
	
	public function setTicketId($ticketId){
		$this->ticketId=$ticketId;
	}
	
	public function getTicketId(){
		return $this->ticketId;
	}

	public function setUserId($userId){
		$this->userId=$userId;
	}
	
	public function getUserId(){
		return $this->userId;
	}

	public function setCreatedAt($createdAt){
		$this->createdAt=$createdAt;
	}

	public function getCreatedAt(){
		return $this->createdAt;
	}

	public function save(){
		try{
			$query = $this->prepare("INSERT INTO comment (comment, ticket_id, user_id, created_at) VALUES (?, ?, ?, ?)");
			$query->bindParam(1, $this->comment);
			$query->bindParam(2, $this->ticketId);
			$query->bindParam(3, $this->userId);
			$query->bindParam(4, $this->createdAt);
			$query->execute();
			return true;
		}catch(PDOException $e){
			error_log('commentModel::save->PDOException '.$e);
			return false;
		}
	}

	public function update(){
		try{
			$query = $this->prepare("UPDATE comment SET comment=?, ticket_id=?, user_id=?, created_at=? WHERE id=?");
			$query->bindParam(1, $this->comment);
			$query->bindParam(2, $this->ticketId);
			$query->bindParam(3, $this->userId);
			$query->bindParam(4, $this->createdAt);
			$query->bindParam(5, $this->id);
			$query->execute();
			return true;
		}catch(PDOException $e){
			error_log('commentModel::update->PDOException '.$e);
			return false;
		}
	}

	public function delete($id){
		try{
			$query = $this->prepare("DELETE FROM comment WHERE id=?");
			$query->bindParam(1, $id);
			$query->execute();
			return true;
		}catch(PDOException $e){
			error_log('commentModel::delete->PDOException '.$e);
			return false;
		}
	}

	public function getAll(){
		$items = [];
		try{
			$query = $this->prepare("SELECT * FROM comment");
			$query->execute();
			while($p=$query->fetch(PDO::FETCH_ASSOC)){
        $item = new CommentModel();
				$item->from($p);
        array_push($items,$item);
      }
      
      return $items;
		}catch(PDOException $e){
			error_log('commentModel::getAll->PDOException '.$e);
			return false;
		}
	}

	public function get($id){
		try{
			$query = $this->prepare("SELECT * FROM comment WHERE id=?");
			$query->bindParam(1, $id);
			$query->execute();
			$p=$query->fetch(PDO::FETCH_ASSOC);
			$this->from($p);
			return true;
		}catch(PDOException $e){
			error_log('commentModel::get->PDOException '.$e);
			return false;
		}
	}

	public function from($array){
		$this->id = $array['id'];
		$this->comment = $array['comment'];
		$this->ticketId = $array['ticket_id'];
		$this->userId = $array['user_id'];
		$this->createdAt = $array['created_at'];
	}

}

?>