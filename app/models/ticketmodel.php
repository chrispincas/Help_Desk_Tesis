<?php

class TicketModel extends Model implements IModel{

	private $id;
	private $subject;
	private $priority;
	private $email;
	private $phone;
	private $description;
	private $categoryId;
	private $subcategoryId;
	private $files;
	private $userId;
	private $ticketStatusId;
	private $createdAt;
	private $modifiedAt;

	public function __construct(){
		parent::__construct();
		$this->priority='';
		$this->subject='';
		$this->email='';
		$this->phone=0;
		$this->description='';
		$this->categoryId=0;
		$this->subcategoryId=0;
		$this->files='';
		$this->userId=0;
		$this->ticketStatusId=0;
		$this->createdAt='';
		$this->modifiedAt='';
	}

	public function save(){
		try{
			$db = $this->db->connect();
			$query=$db->prepare('INSERT INTO ticket(priority, subject, email,phone,description,category_id,subcategory_id,files,user_id,ticket_status_id,created_at,modified_at) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
			$query->bindParam(1, $this->priority);
			$query->bindParam(2, $this->subject);
			$query->bindParam(3, $this->email);
			$query->bindParam(4, $this->phone);
			$query->bindParam(5, $this->description);
			$query->bindParam(6, $this->categoryId);
			$query->bindParam(7, $this->subcategoryId);
			$query->bindParam(8, $this->files);
			$query->bindParam(9, $this->userId);
			$query->bindParam(10, $this->ticketStatusId);
			$query->bindParam(11, $this->createdAt);
			$query->bindParam(12, $this->modifiedAt);
			$query->execute();
			$this->id = $db->lastInsertId();
			return true;
		}catch(PDOException $e){
			error_log('ticketModel::save->PDOException '.$e);
			return false;
		}
	}

	public function get($id){
		try{
			$query=$this->prepare('SELECT * FROM ticket WHERE id=?');
			$query->bindParam(1, $id);
			$query->execute();
			$ticket=$query->fetch(PDO::FETCH_ASSOC);
			if($ticket){
				$this->from($ticket);
				return $this;
			}else{
				error_log('ticketModel::get->Failed: '.$id.' no se encuentra en sistema');
				return false;
			}
		}catch(PDOException $e){
			error_log('ticketModel::get->PDOException '.$e);
			return false;
		}
	}

	public function from($array){
    $this->id = $array['id'];
		$this->priority = $array['priority'];
		$this->subject = $array['subject'];
		$this->email = $array['email'];
		$this->phone = $array['phone'];
		$this->description = $array['description'];
		$this->categoryId = $array['category_id'];
		$this->subcategoryId = $array['subcategory_id'];
		$this->files = $array['files'];
		$this->userId = $array['user_id'];
		$this->ticketStatusId = $array['ticket_status_id'];
		$this->createdAt = $array['created_at'];
		$this->modifiedAt = $array['modified_at'];
	}

	public function getAll(){
		try{
			$items = [];
			$query=$this->prepare('SELECT * FROM ticket');
			$query->execute();
			while($p=$query->fetch(PDO::FETCH_ASSOC)){
        $item = new ticketModel();
				$item->from($p);
        array_push($items,$item);
      }
      
      return $items;
		}catch(PDOException $e){
			error_log('ticketModel::getAll->PDOException '.$e);
			return false;
		}
	}

	public function update(){
		try{
			$query=$this->prepare('UPDATE ticket SET priority=?, category_id=?,subcategory_id=?,ticket_status_id=?, modified_at=? WHERE id=?');
			$query->bindParam(1, $this->priority);
			$query->bindParam(2, $this->categoryId);
			$query->bindParam(3, $this->subcategoryId);
			$query->bindParam(4, $this->ticketStatusId);
			$query->bindParam(5, $this->modifiedAt);
			$query->bindParam(6, $this->id);
			$query->execute();
			return true;
		}catch(PDOException $e){
			error_log('ticketModel::update->PDOException '.$e);
			return false;
		}
	}

	public function commentTicket(){
		try{
			$query=$this->prepare('INSERT INTO comments(ticket_id,user_id,comment) values(?,?,?)');
			$query->bindParam(1, $this->id);
			$query->bindParam(2, $this->userId);
			$query->bindParam(3, $this->comment);
			$query->execute();
			return true;
		}catch(PDOException $e){
			error_log('ticketModel::comment->PDOException '.$e);
			return false;
		}
	}

	public function closeTicket(){
		try{
			$query=$this->prepare('UPDATE ticket SET ticket_status_id=?, modified_at=? WHERE id=?');
			$query->bindParam(1, $this->ticketStatusId);
			$query->bindParam(2, $this->modifiedAt);
			$query->bindParam(3, $this->id);
			$query->execute();
			return true;
		}catch(PDOException $e){
			error_log('ticketModel::close->PDOException '.$e);
			return false;
		}
	}

	public function updateFileUrl(){
		try{
			$query=$this->prepare('UPDATE ticket SET files=? WHERE id=?');
			$query->bindParam(1, $this->files);
			$query->bindParam(2, $this->id);
			$query->execute();
			return true;
		}catch(PDOException $e){
			error_log('ticketModel::updateFileUrl->PDOException '.$e);
			return false;
		}
	}

	public function delete($id){
		try{
			$query=$this->prepare('DELETE FROM ticket WHERE id=?');
			$query->bindParam(1, $id);
			$query->execute();
			return true;
		}catch(PDOException $e){
			error_log('ticketModel::delete->PDOException '.$e);
			return false;
		}
	}

	public function setId($id){
		$this->id=$id;
	}

	public function getId(){
		return $this->id;
	}

	public function setSubject($subject){
		$this->subject=$subject;
	}
	
	public function getSubject(){
		return $this->subject;
	}

	public function setPriority($priority){
		$this->priority=$priority;
	}

	public function getPriority(){
		return $this->priority;
	}

	public function setEmail($email){
		$this->email=$email;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setPhone($phone){
		$this->phone=$phone;
	}

	public function getPhone(){
		return $this->phone;
	}

	public function setDescription($description){
		$this->description=$description;
	}

	public function getDescription(){
		return $this->description;
	}

	public function setCategoryId($categoryId){
		$this->categoryId=$categoryId;
	}

	public function getCategoryId(){
		return $this->categoryId;
	}

	public function setSubcategoryId($subcategoryId){
		$this->subcategoryId=$subcategoryId;
	}

	public function getSubcategoryId(){
		return $this->subcategoryId;
	}

	public function setFiles($files){
		$this->files=$files;
	}

	public function getFiles(){
		return $this->files;
	}

	public function setUserId($userId){
		$this->userId=$userId;
	}

	public function getUserId(){
		return $this->userId;
	}

	public function setTicketStatusId($ticketStatusId){
		$this->ticketStatusId=$ticketStatusId;
	}
	
	public function getTicketStatusId(){
		return $this->ticketStatusId;
	}

	public function setCreatedAt($createdAt){
		$this->createdAt=$createdAt;
	}

	public function getCreatedAt(){
		return $this->createdAt;
	}

	public function setModifiedAt($modifiedAt){
		$this->modifiedAt=$modifiedAt;
	}

	public function getModifiedAt(){
		return $this->modifiedAt;
	}

	

}

?>