<?php

class TicketRelationModel extends Model{

	private $id;
	private $subject;
	private $priority;
	private $email;
	private $phone;
	private $description;
	private $category;
	private $subcategory;
	private $files;
	private $userId;
	private $name;
	private $status;
	private $createdAt;
	private $modifiedAt;

	public function __construct(){
		parent::__construct();
		$this->id=0;
		$this->subject="";
		$this->priority=0;
		$this->email='';
		$this->phone='';
		$this->description='';
		$this->category='';
		$this->subcategory='';
		$this->files='';
		$this->userId=0;
		$this->name='';
		$this->status='';
		$this->createdAt='';
		$this->modifiedAt='';
	}

	public function getAllRelation(){
		try{
			$items = [];
			$query=$this->prepare('SELECT t.id, t.subject, priority, t.email, phone, description, c.category, s.subcategory, files, t.user_id, u.name, ts.ticket_status, t.created_at, t.modified_at
			FROM ticket t 
			LEFT JOIN user u ON(t.user_id=u.id)
			LEFT JOIN category c ON(t.category_id=c.id)
			LEFT JOIN subcategory s ON(t.subcategory_id=s.id)
			LEFT JOIN ticket_status ts ON(t.ticket_status_id=ts.id)
			ORDER BY t.id DESC');
			$query->execute();
			while($p=$query->fetch(PDO::FETCH_ASSOC)){
        $item = new TicketRelationModel();
				$item->setId($p['id']);
				$item->setSubject($p['subject']);
				$item->setPriority($p['priority']);
				$item->setEmail($p['email']);
				$item->setPhone($p['phone']);
				$item->setDescription($p['description']);
				$item->setCategory($p['category']);
				$item->setSubcategory($p['subcategory']);
				$item->setFiles($p['files']);
				$item->setUserId($p['user_id']);
				$item->setName($p['name']);
				$item->setStatus($p['ticket_status']);
				$item->setCreatedAt($p['created_at']);
				$item->setModifiedAt($p['modified_at']);
        array_push($items,$item);
      }
      
      return $items;
		}catch(PDOException $e){
			error_log('ticketModel::getAll->PDOException '.$e);
			return false;
		}
	}

	public function getAllRelationByUserId($id){
		try{
			$items = [];
			$query=$this->prepare('SELECT t.id, t.subject, priority, t.email, phone, description, c.category, s.subcategory, files, t.user_id, u.name, ts.ticket_status, t.created_at, t.modified_at
			FROM ticket t 
			LEFT JOIN user u ON(t.user_id=u.id)
			LEFT JOIN category c ON(t.category_id=c.id)
			LEFT JOIN subcategory s ON(t.subcategory_id=s.id)
			LEFT JOIN ticket_status ts ON(t.ticket_status_id=ts.id)
			WHERE t.user_id= ?');
			$query->bindParam(1,$id);
			$query->execute();
			while($p=$query->fetch(PDO::FETCH_ASSOC)){
        $item = new TicketRelationModel();
				$item->setId($p['id']);
				$item->setSubject($p['subject']);
				$item->setPriority($p['priority']);
				$item->setEmail($p['email']);
				$item->setPhone($p['phone']);
				$item->setDescription($p['description']);
				$item->setCategory($p['category']);
				$item->setSubcategory($p['subcategory']);
				$item->setFiles($p['files']);
				$item->setUserId($p['user_id']);
				$item->setName($p['name']);
				$item->setStatus($p['ticket_status']);
				$item->setCreatedAt($p['created_at']);
				$item->setModifiedAt($p['modified_at']);
        array_push($items,$item);
      }
      return $items;
		}catch(PDOException $e){
			error_log('ticketModel::getAll->PDOException '.$e);
			return false;
		}
	}

	public function get($id){
		try{
			$query=$this->prepare('SELECT t.id, t.subject, priority, t.email, phone, description, c.category, s.subcategory, files, t.user_id, u.name, ts.ticket_status, t.created_at, t.modified_at
			FROM ticket t 
			LEFT JOIN user u ON(t.user_id=u.id)
			LEFT JOIN category c ON(t.category_id=c.id)
			LEFT JOIN subcategory s ON(t.subcategory_id=s.id)
			LEFT JOIN ticket_status ts ON(t.ticket_status_id=ts.id)
			WHERE t.id = ?');
			$query->bindParam(1, $id);
			$query->execute();
			$ticket=$query->fetch(PDO::FETCH_ASSOC);
			$this->from($ticket);
			return $this;
		}catch(PDOException $e){
			error_log('ticketModel::get->PDOException '.$e);
			return false;
		}
	}

	public function compareUserTicketPermission($id,$userId){
		try{
			$query=$this->prepare('SELECT id
			FROM ticket
			WHERE id=? AND user_id=?');
			$query->bindParam(1, $id);
			$query->bindParam(2, $userId);
			$query->execute();
			if($query->rowCount() == 1){
				return true;
			}else{
				return false;
			}
		}catch(PDOException $e){
			error_log('ticketModel::get->PDOException '.$e);
			return false;
		}
	}
	
	public function from($array){
		$this->id = $array['id'];
		$this->subject = $array['subject'];
		$this->priority = $array['priority'];
		$this->email = $array['email'];
		$this->phone = $array['phone'];
		$this->description = $array['description'];
		$this->category = $array['category'];
		$this->subcategory = $array['subcategory'];
		$this->files = $array['files'];
		$this->userId = $array['user_id'];
		$this->name = $array['name'];
		$this->status = $array['ticket_status'];
		$this->createdAt = $array['created_at'];
		$this->modifiedAt = $array['modified_at'];
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

	public function setCategory($category){
		$this->category=$category;
	}
	
	public function getCategory(){
		return $this->category;
	}

	public function setSubcategory($subcategory){
		$this->subcategory=$subcategory;
	}
	
	public function getSubcategory(){
		return $this->subcategory;
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

	public function setName($name){
		$this->name=$name;
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function setStatus($status){
		$this->status=$status;
	}
	
	public function getStatus(){
		return $this->status;
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