<?php

class TicketStatusModel extends Model implements IModel{

	private $id;
	private $status;

	public function __construct(){
		parent::__construct();
		$this->status = "";
	}

	public function save(){
		try{
			$query=$this->prepare('INSERT INTO ticket_status(status) values(?)');
			$query->bindParam(1, $this->status);
			$query->execute();
			return true;
		}catch(PDOException $e){
			error_log('ticketStatusModel::save->PDOException '.$e);
			return false;
		}
	}

	public function get($id){
		try{
			$query=$this->prepare('SELECT * FROM ticket_status WHERE id=?');
			$query->bindParam(1, $id);
			$query->execute();
			$ticketStatus=$query->fetch(PDO::FETCH_ASSOC);
			return $ticketStatus;
		}catch(PDOException $e){
			error_log('ticketStatusModel::get->PDOException '.$e);
			return false;
		}
	}

	public function getAll(){
		$items = [];
		try{
			$items = [];
			$query=$this->prepare('SELECT * FROM ticket_status');
			$query->execute();
			while($p=$query->fetch(PDO::FETCH_ASSOC)){
        $item = new TicketStatusModel();
				$item->from($p);
        array_push($items,$item);
      }
      
      return $items;
		}catch(PDOException $e){
			error_log('ticketStatusModel::getAll->PDOException '.$e);
			return false;
		}
	}

	public function update(){
		try{
			$query=$this->prepare('UPDATE ticket_status SET status=? WHERE id=?');
			$query->bindParam(1, $this->status);
			$query->bindParam(2, $this->id);
			$query->execute();
			return true;
		}catch(PDOException $e){
			error_log('ticketStatusModel::update->PDOException '.$e);
			return false;
		}
	}

	public function delete($id){
		try{
			$query=$this->prepare('DELETE FROM ticket_status WHERE id=?');
			$query->bindParam(1, $id);
			$query->execute();
			return true;
		}catch(PDOException $e){
			error_log('ticketStatusModel::delete->PDOException '.$e);
			return false;
		}
	}

	public function from($array){
		$this->id = $array['id'];
		$this->status = $array['ticket_status'];
	}

	public function setId($id){
		$this->id=$id;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function setStatus($status){
		$this->status=$status;
	}
	
	public function getStatus(){
		return $this->status;
	}

}

?>