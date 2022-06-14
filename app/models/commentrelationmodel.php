<?php

class CommentRelationModel extends Model{

	private $id;
	private $comment;
	private $ticket_id;
	private $userId;
	private $userName;
	private $createdAt;

	public function __construct(){
		parent::__construct();
		$this->id=0;
		$this->comment='';
		$this->ticket_id=0;
		$this->userId=0;
		$this->userName='';
		$this->createdAt='';
	}

	public function getCommentsByTicketId($id){
		try{
			$items = [];
			$query=$this->prepare('SELECT c.id, c.comment, c.ticket_id, c.user_id, u.name, c.created_at
			FROM comment c
			LEFT JOIN user u ON (u.id=c.user_id)
			WHERE c.ticket_id=?
			ORDER BY c.created_at ASC');
			$query->bindParam(1, $id);
			$query->execute();
			while($p=$query->fetch(PDO::FETCH_ASSOC)){
				$item = new CommentRelationModel();
				$item->from($p);
				array_push($items,$item);
			}
			return $items;
		}
		catch(PDOException $e){
			error_log('commentRelationModel::getAll->PDOException '.$e);
      return false;
		}
	}

	public function from($array){
		$this->id=$array['id'];
		$this->comment=$array['comment'];
		$this->ticket_id=$array['ticket_id'];
		$this->userId=$array['user_id'];
		$this->userName=$array['name'];
		$this->createdAt=$array['created_at'];
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
	
	public function setTicket_id($ticket_id){
		$this->ticket_id=$ticket_id;
	}
	
	public function getTicket_id(){
		return $this->ticket_id;
	}

	public function setUserId($userId){
		$this->userId=$userId;
	}
	
	public function getUserId(){
		return $this->userId;
	}

	public function setUserName($userName){
		$this->userName=$userName;
	}
	
	public function getUserName(){
		return $this->userName;
	}

	public function setCreatedAt($createdAt){
		$this->createdAt=$createdAt;
	}
	
	public function getCreatedAt(){
		return $this->createdAt;
	}
	
}

?>